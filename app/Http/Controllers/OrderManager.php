<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;

class OrderManager extends Controller
{
    public function showCheckout(){
        return view('checkout');
    }

   public function postCheckout(Request $request){

        $request->validate([
           'address' => 'required',
           'phone' => 'required',
           'pin_code' => 'required',
        ]);

        $cartItems = DB::table("carts")
            ->join('products','carts.product_id', '=', 'products.id')
            ->select("carts.product_id",DB::raw("count(*) as quantity"),'products.price','products.title')
            ->where("carts.user_id", auth()->user()->id)
            ->groupBy("carts.product_id","products.price","products.title")
            ->get();

        if ($cartItems->isEmpty()){
            return redirect(route('cart.show'));
        }

        $productIds = [];
        $quantitis = [];
        $totalPrice = 0;
        $lineItems = [];

        foreach ($cartItems as $cartItem){
            $productIds[] = $cartItem->product_id;
            $quantitis[] = $cartItem->quantity;
            $totalPrice += $cartItem->price * $cartItem->quantity;

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $cartItem->title,
                    ],
                    'unit_amount' => $cartItem->price * 100,
                ],
                'quantity' => $cartItem->quantity,
            ];
        }

        $order = Order::create([
            'user_id'=> auth()->user()->id,
            'address'=>$request->address,
            'pin_code'=>$request->pin_code,
            'phone'=>$request->phone,
            'product_id'=>json_encode($productIds),
            'quantity'=>json_encode($quantitis),
            'total_price'=>$totalPrice,
        ]);

        DB::table('carts')->where("user_id",auth()->user()->id)->delete();



        if ($order){

            $stripe = new StripeClient(config("app.STRIPE_KEY"));

            $checkoutSession = $stripe->checkout->sessions->create([
                'success_url' => route('payment.success', ['order_id' => $order->id]),
                'cancel_url' => route('payment.error'),
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'customer_email' => auth()->user()->email,
                'metadata' => [
                    'order_id' => $order->id
                ]
            ]);

            return redirect($checkoutSession->url);

        }
        else
            return redirect(route('cart.show'))->with("error","Error occurred");

    }

   public function paymentSuccess($order_id)
   {
      return "success" . $order_id;
   }

   public function paymentError()
   {
      return "error";
   }

}
