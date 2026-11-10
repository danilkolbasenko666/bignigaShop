<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\MainController as AdminMainController;



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

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/', function () {
    return view('index');
});*/

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// корзины
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/del-item/{product_id}', [CartController::class, 'delItem'])->name('cart.del_item');
Route::get('/cart/show', [CartController::class, 'show'])->name('cart.show');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::match(['get', 'post'], '/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// гости
Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
    
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

// авторизованные
Route::middleware('auth')->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    
    // админ
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/', [AdminMainController::class, 'index'])->name('admin.index');
    });
});