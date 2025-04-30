@extends("layouts.default")
@section("content")
    <main class="container">
        <section class="mt-5">
            <div class="row">
            @foreach($products as $product)
                <div class="col-4">
                    <div class="card text-center p-2 shadow">
                        <img src="{{$product->image}}" alt="">
                        <a href="{{route('details',$product->slug)}}" class="text-decoration-none mt-1">
                            <h4>{{$product->title}}</h4>
                        </a>
                        <h5><b>Price: </b>{{$product->price}}$</h5>
                    </div>
                </div>
            @endforeach
            </div>
        </section>
    </main>
@endsection
