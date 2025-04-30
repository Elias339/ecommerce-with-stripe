@extends("layouts.default")
@section("content")
    <main class="container">
        <section class="mt-5">
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="card p-2 shadow">
                        <img src="{{$product->image}}" alt="">
                         <h4>{{$product->title}}</h4>
                        <h6>{{$product->description}}</h6>
                        <h5 class="text-center"><b>Price: </b>{{$product->price}}$</h5>

                        @if(!$isCarted)
                            <div class="d-flex justify-content-center mb-4">
                                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success">Add to cart</a>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
