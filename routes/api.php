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

Route::group(['prefix' => 'user', 'namespace' => '\App\Http\Controllers\API'], function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
});
Route::group(['prefix' => 'books', 'namespace' => '\App\Http\Controllers\API'], function () {
    Route::get('/', 'BookController@index');
    Route::post('/', 'BookController@store');
    Route::put('/{id}', 'BookController@update');
    Route::delete('/destroy/{id}', 'BookController@destroy');
});

Route::group(['prefix' => 'checkout', 'namespace' => '\App\Http\Controllers\API'], function () {
    Route::post('/', 'CheckoutController@store');
    Route::post('/{id}', 'CheckoutController@destroy');
});

