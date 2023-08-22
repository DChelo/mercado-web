<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

// Routes auth
Auth::routes();
Route::get('/', [ProductController::class, 'home'])->name('products.home');

// Routes autenticadas
Route::group(['middleware' => ['auth']], function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home');

	// User route
	Route::group(['prefix' => 'users', 'controller' => UserController::class], function () {
		Route::get('/', 'index')->name('users.index')->middleware('can:users.index');
		Route::get('/create', 'create')->name('users.create')->middleware('can:users.create');
		Route::post('/', 'store')->name('users.store')->middleware('can:users.store');
		Route::get('/{user}/edit', 'edit')->name('users.edit')->middleware('can:users.edit');
		Route::put('/{user}', 'update')->name('users.update')->middleware('can:users.update');
		Route::delete('/{user}', 'destroy')->name('users.destroy')->middleware('can:users.destroy');
	});

	// Products route
	Route::group(['prefix' => 'products', 'controller' => ProductController::class], function () {
        Route::get('/', 'index')->name('products.index')->middleware('can:products.index');
        Route::post('/store', 'store')->name('products.store')->middleware('can:products.store');
        Route::post('/update/{product}', 'update')->name('products.update')->middleware('can:products.update');
        Route::delete('/{product}', 'destroy')->name('products.destroy')->middleware('can:products.destroy');
    });

	// Categories route
	Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
		Route::get('/', 'index')->name('categories.index')->middleware('can:categories.index');
		Route::get('/get-all', 'getAll')->name('categories.get-all');
		Route::get('/{category}', 'show')->name('categories.show')->middleware('can:categories.show');
		Route::post('/store', 'store')->name('categories.store')->middleware('can:categories.store');
		Route::post('/update/{category}', 'update')->name('categories.update')->middleware('can:categories.update');
		Route::delete('/{category}', 'destroy')->name('categories.destroy')->middleware('can:categories.destroy');
	});

	Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
});

Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');


