<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginStore'])->name('login.store');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/home', [DashboardController::class, 'index'])->name('home');

        Route::get('/brand', [BrandController::class, 'index'])->name('brand');
        Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/brand/edit/{brand:slug}', [BrandController::class, 'edit'])->name('brand.edit');
        Route::post('/brand/update/{brand:slug}', [BrandController::class, 'update'])->name('brand.update');
        Route::delete('/brand/destroy/{brand:slug}', [BrandController::class, 'destroy'])->name('brand.destroy');

        Route::get('/category', [CategoryController::class, 'index'])->name('category');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/edit/{category:slug}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/update/{category:slug}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/destroy/{category:slug}', [CategoryController::class, 'destroy'])->name('category.destroy');

        Route::get('/product', [ProductController::class, 'index'])->name('product');
        Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/product/edit/{product:slug}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/product/update/{product:slug}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/product/destroy/{product:slug}', [ProductController::class, 'destroy'])->name('product.destroy');
    });
});
