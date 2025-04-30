@extends("layouts.default")
@section("content")
    <main class="container">
        <section class="mt-5">
            <div class="row">
                <div class="col-10 offset-1">
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
                    <h2>Checkout</h2>
                    <form action="{{route('checkout.post')}}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address" required>
                        </div>

                        <div class="mb-3">
                            <label for="pin_code" class="form-label">Pin Code</label>
                            <input type="text" class="form-control" name="pin_code" id="pin_code" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Process to Payment</button>

                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection


