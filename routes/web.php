<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/shop', function () {
    return view('shop_home');
});

Route::get('products', 'ProductController@index')->name('products.index');
Route::get('products/{product}', 'ProductController@show')->name('products.show');

Route::middleware(['auth'])->group(function () {
    Route::post('orders', 'OrderController@store')->name('orders.store');
    Route::get('cart', 'OrderController@showCart')->name('orders.show');
    Route::post('orders/delete', 'OrderController@destroyProduct')
        ->name('orders.product.destroy');
});

Route::get('/admin', function() {
    return view('admin.dashboard');
})->name('dashboard')->middleware('auth');

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->group(function () {

    Route::resource('products', 'ProductController');
    Route::resource('categories', 'CategoryController');
});
