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
    //product
    Route::resource('product', ProductController::class);

    Route::get('create-product-add/{slug}', [ProductController::class, 'createProductAdd'])->name('create-product-add');
    Route::post('create-product-add/{slug}', [ProductController::class, 'storeProductAdd'])->name('store-product-add');
    Route::get('product-add-transaction', [ProductController::class, 'productAddTransaction'])->name('product-add-transaction');

    Route::get('create-product-remove/{slug}', [ProductController::class, 'createProductRemove'])->name('create-product-remove');
    Route::post('create-product-remove/{slug}', [ProductController::class, 'storeProductRemove'])->name('store-product-remove');
    Route::get('product-remove-transaction', [ProductController::class, 'productRemoveTransaction'])->name('product-remove-transaction');

    Route::post('product-upload', [ProductController::class, 'imageUpload'])->name('imageUpload');
});
