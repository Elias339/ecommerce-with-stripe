<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
           'email'=>'required',
           'password'=>'required',
        ]);

        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)){
            return redirect()->intended(route("home"));
        }
        return redirect("login")->with("error","Invalid Email or Password");

    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|min:6',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return redirect()->intended(route("login"));

    }

    public function logout(){
        Auth::logout();
        return redirect("login");
    }


}
