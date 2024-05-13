<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/product/list',[ProductController::class, 'index'])->name('product.index');
Route::get('/product/create',[ProductController::class, 'create'])->name('product.create');
Route::post('/product/store',[ProductController::class, 'store'])->name('product.store');

Route::get('/product/search',[ProductController::class, 'searchProduct'])->name('product.search');
Route::post('/product/search/show',[ProductController::class, 'searchProductShow'])->name('product.search.show');
Route::get('cart/view', [ProductController::class, 'cartView'])->name('addto.cart');


Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('cart/change/price', [CartController::class, 'qtyChangePrice'])->name('change.qty.price');



Route::get('checkout',[CheckoutController::class, 'index'])->name('checkout.index');
Route::post('order/place',[CheckoutController::class, 'placeOrder'])->name('order.place');



Route::get('order/list',[OrderController::class, 'index'])->name('order.index');
