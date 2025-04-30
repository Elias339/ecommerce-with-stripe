@extends("layouts.default")
@section("content")
    <main class="container">
        <section>
            @foreach($cartItems as $product)
                <div class="card shadow mt-5">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{$product->image}}" alt="" style="height: 100px; width: 100px;">
                        </div>
                        <div class="col-4 mt-3">
                            <h4>{{$product->title}}</h4>
                            <h5><b>Price: </b>{{$product->price}} $</h5>
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <a href="" class="btn btn-sm btn-danger align-items-center align-content-center m-3">Delete</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </main>
@endsection
