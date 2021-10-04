<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {   
    return $request->user();
});

Route::get('/test', 'UserController@test');

/** 
 * User Routes
 */
Route::get('/user/getAllUsers', 'UserController@getAllUsers');
Route::get('/user/{id}', 'UserController@getUserByID');
Route::post('/user/register', 'UserController@register');
Route::post('/user/login', 'UserController@login');
Route::put('/user/update', 'UserController@updateUser');
Route::delete('/user/delete/{id}', 'UserController@deleteUser');

/**
 * Product Routes
 */
Route::get('/products', 'ProductController@getAllProducts');
Route::get('/products/{id}', 'ProductController@getProductByID');
Route::get('/products/search/name', 'ProductController@searchProductsByName');
Route::post('/products/search/desc', 'ProductController@searchProductsByDesc');
Route::post('/products/create', 'ProductController@createProduct');
Route::put('/products/update', 'ProductController@updateProduct');
Route::delete('/products/delete/{id}', 'ProductController@deleteProduct');

/**
 * Cart Routes
 */
Route::get('/cart/carts', 'CartController@getAllCarts');
Route::get('/cart/{id}', 'CartController@getCartByID');
Route::get('/cart/user/{userID}', 'CartController@getCartByUser');
Route::get('/cart/products/{id}', 'CartController@getCartProducts');
Route::post('/cart/create', 'CartController@createCart');
Route::post('/cart/add', 'CartController@addToCart');
Route::post('/cart/remove', 'CartController@removeFromCart');
Route::put('/cart/update', 'CartController@updateCart');
Route::delete('/cart/delete/{id}', 'CartController@deleteCart');

