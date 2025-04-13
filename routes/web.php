<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OtpMailerController;


// Route::get('details/{product}', [StoreController::class, 'productDetails'])->name('product.details');
// Route::get('variant/{id}', [StoreController::class, 'DynamicDetail'])->name('product.DynamicDetail');
// Route::get('change/{id}', [StoreController::class, 'DynamicChange'])->name('product.DynamicChange');
// Route::post('add_to_cart', [StoreController::class, 'addToCart'])->name('addToCart');
// Route::get('myCart', [StoreController::class, 'showCart'])->name('showCart');
// Route::post('updateOrder', [StoreController::class, 'updateOrder'])->name('updateOrder');
// Route::delete('remove/cartProduct/{add_to_cart}', [StoreController::class, 'removeOrder'])->name('remove.order');
// Route::get('detail/Product/{add_to_cart}', [StoreController::class, 'cartProductDetail'])->name('cart.prodDetail');
// Route::get('deleteCart', [StoreController::class, 'deleteCartProducts'])->name('delete.cart');

Route::middleware('guest')->group(function(){
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');
    Route::post('Otp', [OtpMailerController::class, 'sendOtp'])->name('sendOtp');
    Route::post('resend',[OtpMailerController::class, 'resendOtp'])->name('resendOtp');
    Route::get('otpVerify', [OtpMailerController::class, 'verification'])->name('verification');
    Route::post('verify',[OtpMailerController::class, 'verify'])->name('verify.otp');
});
Route::middleware('auth:web')->prefix('user')->group(function() {
    Route::get('dashboard', [UserController::class, 'index'])->name('home');
    Route::get('invoice', [UserController::class, 'getInvoice'])->name('invoice.list');
    Route::get('invoice/create', [UserController::class, 'addInvoice'])->name('add.invoice');
    Route::post('invoice/store', [UserController::class, 'storeInvoice'])->name('store.invoice');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
