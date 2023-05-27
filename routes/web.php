<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// View Products
Route::get('/', [App\Http\Controllers\PhoneController::class, 'index']);



Auth::routes();


// Cart
Route::get('/cart', [PhoneController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{id}', [PhoneController::class, 'addToCart'])->name('add_to_cart');
Route::patch('/update-cart', [PhoneController::class, 'updateCart'])->name('update_cart');
Route::delete('/remove-from-cart', [PhoneController::class, 'removeCart'])->name('remove_from_cart');


// Checkout
Route::get('/checkout', [App\Http\Controllers\PhoneController::class, 'Checkout'])->middleware('auth');

// invoice
Route::post('/invoice', [App\Http\Controllers\PhoneController::class, 'invoice'])->middleware('auth')->name('invoice');
Route::get('/invoice/{id}', [App\Http\Controllers\PhoneController::class, 'getInvoice'])->middleware('auth');

