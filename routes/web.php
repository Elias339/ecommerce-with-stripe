<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ProductManager;
use Illuminate\Support\Facades\Route;


Route::get("/",[ProductManager::class,'index'])->name('home');

Route::get("details/{slug}",[ProductManager::class,'details'])->name('details');

Route::get("login",[AuthManager::class,'login'])->name('login');
Route::post("login",[AuthManager::class,'loginPost'])->name('login.post');

Route::get("register",[AuthManager::class,'register'])->name('register');
Route::post("register",[AuthManager::class,'registerPost'])->name('register.post');

Route::get("logout",[AuthManager::class,'logout'])->name('logout');

Route::middleware("auth")->group(function (){
    Route::get("cart/{id}",[ProductManager::class,'addToCart'])->name('cart.add');
    Route::get("show/cart",[ProductManager::class,'showCart'])->name('cart.show');

});

