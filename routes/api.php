<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/register','Api\AuthController@register');
Route::post('/login','Api\AuthController@login');
Route::get('/login','Api\AuthController@user')->middleware('auth:api');;


Route::post('/password/email','Api\ForgotPasswordController@sendResetLinkEmail');

Route::post('/password/reset','Api\ResetPasswordController@reset');

//Product

Route::get('/products','Api\ProductController@index')->name('products.show');
Route::get('/product/{id}','Api\ProductController@show')->name('products.show');
Route::post('/product','Api\ProductController@store')->middleware('auth:api');
Route::put('/product/{id}','Api\ProductController@update')->middleware('auth:api');
Route::delete('/product/{id}','Api\ProductController@destroy')->middleware('auth:api');

//brand

Route::get('/brands','Api\BrandController@index')->name('brands.show');
Route::get('/brand/{id}','Api\BrandController@show')->name('brand.show');
Route::post('/brand','Api\BrandController@store')->middleware('auth:api');
Route::put('/brand/{id}','Api\BrandController@update')->middleware('auth:api');
Route::delete('/brand/{id}','Api\BrandController@destroy')->middleware('auth:api');


//brand

Route::get('/categories','Api\CategoryController@index')->name('categories.show');
Route::get('/category/{id}','Api\CategoryController@show')->name('category.show');
Route::post('/category','Api\CategoryController@store')->middleware('auth:api');
Route::put('/category/{id}','Api\CategoryController@update')->middleware('auth:api');
Route::delete('/category/{id}','Api\CategoryController@destroy')->middleware('auth:api');

//stock

Route::get('/stocks','Api\StockController@index')->name('stocks.show');
Route::get('/stock/{id}','Api\StockController@show')->name('stock.show');
Route::post('/stock','Api\StockController@store')->middleware('auth:api');
Route::put('/stock/{id}','Api\StockController@update')->middleware('auth:api');
Route::delete('/stock/{id}','Api\StockController@destroy')->middleware('auth:api');

//damaged_stock

Route::get('/damagedstocks','Api\DamagedStockController@index')->name('damagedstocks.show');
Route::get('/damagedstock/{id}','Api\DamagedStockController@show')->name('damagedstock.show');
Route::post('/damagedstock','Api\DamagedStockController@store')->middleware('auth:api');
Route::put('/damagedstock/{id}','Api\DamagedStockController@update')->middleware('auth:api');
Route::delete('/damagedstock/{id}','Api\DamagedStockController@destroy')->middleware('auth:api');

//sales

Route::get('/sales','Api\SaleController@index')->name('sale.show');
Route::get('/sale/{id}','Api\SaleController@show')->name('sale.show');
Route::post('/sale','Api\SaleController@store')->middleware('auth:api');
Route::put('/sale/{id}','Api\SaleController@update')->middleware('auth:api');
Route::delete('/sale/{id}','Api\SaleController@destroy')->middleware('auth:api');
