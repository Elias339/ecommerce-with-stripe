@extends("layouts.auth")
@section("style")
    <style>
        html,
        body{
            height: 100%;
        }

        .form-signin{
            max-width: 330px;
            padding: 1rem;
        }
        .form-signin .form-floating:focus-within{
            z-index: 2;
        }

        .form-signin input[type="email"]{
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"]{
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

    </style>
@endsection

@section("content")
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="">
            @csrf
            <img src="" alt="">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput">
                <label for="floatingInput">Email Address</label>
                @error('email')
                <span class="text-danger">{{message}}</span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword">
                <label for="floatingPassword">Password</label>
                @error('password')
                <span class="text-danger">{{message}}</span>
                @enderror
            </div>

            <div class="form-check text-start my-3">
                <input type="checkbox" name="rememberme" class="form-check-input" id="flexCheckDefault" value="remember-me">
                <label class="form-check-label" for="flexCheckDefault">Remember me</label>
            </div>

        </form>
    </main>
@endsection
