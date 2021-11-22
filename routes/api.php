<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\ContentController;

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

Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth:api'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/profile', [AuthController::class, 'profile']);
    });
});

Route::prefix('v1/admin')->middleware(['auth:api'])->group(function () {
    // Category
    Route::get('categories', [CategoryController::class, 'getAll']);
    Route::get('categories/{id}', [CategoryController::class, 'getOne']);
    Route::post('categories', [CategoryController::class, 'create']);
    Route::put('categories/{id}', [CategoryController::class, 'update']);
    // Route::delete('categories/{id}', [CategoryController::class, 'delete']);

    // Title
    Route::get('titles/by-category/{id}', [TitleController::class, 'getByCategory']);
    Route::get('titles/{id}', [TitleController::class, 'getOne']);
    Route::post('titles', [TitleController::class, 'create']);
    Route::put('titles/{id}', [TitleController::class, 'update']);
    // Route::delete('titles/{id}', [TitleController::class, 'delete']);

    // Content
    Route::get('contents/by-title/{id}', [ContentController::class, 'getByTitle']);
    Route::get('contents/{id}', [ContentController::class, 'getOne']);
    Route::post('contents', [ContentController::class, 'create']);
    Route::put('contents/{id}', [ContentController::class, 'update']);
    // Route::delete('contents/{id}', [ContentController::class, 'delete']);
});
