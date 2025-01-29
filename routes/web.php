<?php

use App\Http\Controllers\Admin\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//  Admin Route
Route::get('/admin/login', [PageController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [PageController::class, 'login'])->name('postlogin');


Route::group(['prefix' => "admin", "namespace" => "Admin"], function () {
    Route::get('/', [PageController::class, 'showDashboard']);
});
