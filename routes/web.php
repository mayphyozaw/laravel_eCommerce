<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\ProductsController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

#### Auth ####
Route::group(['middleware' => ['RedirectIfAuth']], function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('user_login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('userPostLogin');


    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postregister');
});

Route::group(['middleware' => ['RedirectIfNotAuth']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('user_logout');
    Route::get('/profile', [FrontPageController::class, 'showProfile'])->name('profile');
});
#### Auth ####



Route::get('/', [FrontPageController::class, 'home'])->name('home');
Route::get('product', [FrontPageController::class, 'allProducts'])->name('product');

Route::get('/product/{slug}', [ProductsController::class, 'detail']);


Route::get('/authuser', function () {
    $user = User::find(1);
    auth()->login($user);
    return auth()->user();
});

//  Admin Route
Route::get('/admin/login', [PageController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [PageController::class, 'login'])->name('postlogin');

Route::group(['prefix' => "admin", 'middleware' => ['Admin']], function () {
    Route::post('/logout', [PageController::class, 'logout'])->name('logout');
    Route::get('/', [PageController::class, 'showDashboard'])->name('dashboard');

    Route::resource('category', CategoryController::class);
    Route::resource('color', ColorController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('supplier', SupplierController::class);

    Route::resource('income', IncomeController::class);
    Route::resource('expense', ExpenseController::class);

    //product
    Route::resource('product', ProductController::class);
    Route::get('create-product-add/{slug}', [ProductController::class, 'createProductAdd'])->name('create-product-add');
    Route::post('create-product-add/{slug}', [ProductController::class, 'storeProductAdd'])->name('store-product-add');
    Route::get('product-add-transaction', [ProductController::class, 'productAddTransaction'])->name('product-add-transaction');

    Route::get('create-product-remove/{slug}', [ProductController::class, 'createProductRemove'])->name('create-product-remove');
    Route::post('create-product-remove/{slug}', [ProductController::class, 'storeProductRemove'])->name('store-product-remove');
    Route::get('product-remove-transaction', [ProductController::class, 'productRemoveTransaction'])->name('product-remove-transaction');

    Route::post('product-upload', [ProductController::class, 'imageUpload'])->name('imageUpload');

    Route::get('order', [OrderController::class, 'orderLists'])->name('order');
    Route::get('changeOrder', [OrderController::class, 'changeOrderStatus'])->name('changeOrder');
});
Route::get('/locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back()->with('success', 'Language Switched');
});
Route::resource('about', AboutController::class);
