<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController};

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

Route::get('/users',            [UserController::class, 'index'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::post('/users',           [UserController::class, 'store']);
Route::put('/users/update',     [UserController::class, 'update']);
Route::post('/login',           [UserController::class, 'login']);
Route::post('/users/upload',    [UserController::class, 'upload'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::get('/users/avatar/{filename}', [UserController::class, 'getImage']);
Route::get('/users/detail/{id}',[UserController::class, 'detail'] );
Route::delete('/users/{id}',[UserController::class, 'delete'] );
