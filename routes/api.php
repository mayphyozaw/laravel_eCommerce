<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\ReviewApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeApiController::class, 'home']);
Route::get('/product/{slug}', [ProductApiController::class, 'detail']);
Route::post('make-review/{slug}', [ReviewApi::class, 'makeReview'])->name('make-Review');
Route::post('addToCart', [CartApiController::class, 'addToCart'])->name('addToCart');
Route::get('getCart', [CartApiController::class, 'getCart'])->name('getCart');
Route::post('updateCartQty', [CartApiController::class, 'updateQty'])->name('updateCartQty');
Route::post('removeCart', [CartApiController::class, 'removeQty'])->name('removeCart');
Route::post('checkout', [CartApiController::class, 'checkout'])->name('checkout');
Route::get('order', [CartApiController::class, 'order'])->name('order');
Route::post('changePassword', [AuthApiController::class, 'changePassword'])->name('changePassword');
Route::get('profile', [ProfileApiController::class, 'myprofile'])->name('profile');
Route::post('editProfile', [ProfileApiController::class, 'editProfile'])->name('editprofile');
