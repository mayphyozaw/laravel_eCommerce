<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//  Admin Route
Route::get('/admin/login', [PageController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [PageController::class, 'login'])->name('postlogin');

Route::group(['prefix' => "admin"], function () {
    Route::post('/logout', [PageController::class, 'logout'])->name('logout');
    Route::get('/', [PageController::class, 'showDashboard']);
    Route::resource('category', CategoryController::class);
    Route::resource('color', ColorController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('product', ProductController::class);
    Route::post('product-upload', [ProductController::class, 'imageUpload'])->name('imageUpload');
});
