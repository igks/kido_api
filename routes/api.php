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

Route::prefix('/v1')->middleware(['custom.auth'])->group(function () {
    Route::get('categories', 'App\Http\Controllers\ApiController@categories');
    Route::get('titles/{categories_id}', 'App\Http\Controllers\ApiController@titleByCategory');
    Route::get('contents/{title_id}', 'App\Http\Controllers\ApiController@contentByTitle');
    Route::get('contents/{id}/show', 'App\Http\Controllers\ApiController@contentById');
    Route::post('favorites', 'App\Http\Controllers\ApiController@favorites');
    Route::post('search', 'App\Http\Controllers\ApiController@search');
});

Route::prefix('/v1/admin')->middleware(['custom.auth'])->group(function () {
    Route::get('categories', 'App\Http\Controllers\ApiController@categories');
    Route::get('titles/{categories_id}', 'App\Http\Controllers\ApiController@titleByCategory');
    Route::get('contents/{title_id}', 'App\Http\Controllers\ApiController@contentByTitle');
    Route::get('contents/{id}/show', 'App\Http\Controllers\ApiController@contentById');
    Route::post('favorites', 'App\Http\Controllers\ApiController@favorites');
    Route::post('search', 'App\Http\Controllers\ApiController@search');
});
