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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
use App\Http\Controllers\UserController;
Route::get('/users',                   [UserController::class, 'index'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::post('/users',                  [UserController::class, 'store']);
Route::put('/users/update',            [UserController::class, 'update'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::post('/login',                  [UserController::class, 'login']);
Route::post('/users/upload',           [UserController::class, 'upload'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::get('/users/avatar/{filename}', [UserController::class, 'getImage'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::get('/users/detail/{id}',       [UserController::class, 'detail'] )->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::delete('/users/{id}',           [UserController::class, 'delete'] )->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);

use App\Http\Controllers\PerfilController;
Route::get('/perfil',                   [PerfilController::class, 'index'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::post('/perfil',                  [PerfilController::class, 'create'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::put('/perfil/update',            [PerfilController::class, 'update'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::delete('/perfil/{id}',           [PerfilController::class, 'delete'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::get('/perfil/detail/{id}',       [PerfilController::class, 'detail'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);

use App\Http\Controllers\PermisoController;
Route::post('/permisos',                  [PermisoController::class, 'create'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::put('/permisos/update',            [PermisoController::class, 'update'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::get('/permisos',                   [PermisoController::class, 'index'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::delete('/permisos/{id}',           [PermisoController::class, 'delete'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::get('/permisos/detail/{id}',       [PermisoController::class, 'detail'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);

use App\Http\Controllers\PerfilUsuarioController;
Route::post('/perfiluser',                  [PerfilUsuarioController::class, 'create'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::put('/perfiluser/update',            [PerfilUsuarioController::class, 'update'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::get('/perfiluser',                   [PerfilUsuarioController::class, 'index'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::delete('/perfiluser/{id}',           [PerfilUsuarioController::class, 'delete'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::get('/perfiluser/detail/{id}',       [PerfilUsuarioController::class, 'detail'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);


use App\Http\Controllers\PerfilPermisoController;
Route::post('/perfilpermiso',                  [PerfilPermisoController::class, 'create'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::put('/perfilpermiso/update',            [PerfilPermisoController::class, 'update'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::get('/perfilpermiso',                   [PerfilPermisoController::class, 'index'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::delete('/perfilpermiso/{id}',           [PerfilPermisoController::class, 'delete'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::get('/perfilpermiso/detail/{id}',       [PerfilPermisoController::class, 'detail'])->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);