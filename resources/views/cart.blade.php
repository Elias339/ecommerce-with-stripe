@extends("layouts.default")
@section("content")
    <main class="container">
        <section>
            @if(session()->has("success"))
                <div class="alert alert-success">
                    {{session()->get("success")}}
                </div>
            @endif

            @if(session()->has("error"))
                <div class="alert alert-danger">
                    {{session()->get("error")}}
                </div>
            @endif

            @foreach($cartItems as $product)
                <div class="card shadow mt-5">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{$product->image}}" alt="" style="height: 100px; width: 100px;">
                        </div>
                        <div class="col-4 mt-3">
                            <h4>{{$product->title}}</h4>
                            <h5><b>Price: </b>${{$product->price}} | Quantity: {{$product->quantity}}</h5>
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <a href="" class="btn btn-sm btn-danger align-items-center align-content-center m-3">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach

           @if($cartItems->isEmpty())
           <h2 class="text-danger mt-5">There is no products to checkout.Please add to cart any product....</h2>
            @else
                <div class="mt-5">
                    <a href="{{route('checkout.show')}}" class="btn btn-success shadow">Checkout</a>
                </div>
           @endif

        </section>
    </main>
@endsection
