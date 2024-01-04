<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DisCountController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::resource('category', CategoryController::class);
Route::resource('discount', DisCountController::class);
Route::delete('discount/{id}/remove',[DisCountController::class,'removediscount']);
Route::get('product', [ProductController::class,'index']);
Route::get('product/{id}', [ProductController::class,'show']);
Route::post('product/{id}/update', [ProductController::class,'update']);
Route::post('product', [ProductController::class,'store']);
Route::delete('product/{id}', [ProductController::class,'destroy']);
