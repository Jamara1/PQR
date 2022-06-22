<?php

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

Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    /* Users */
    Route::get('user-profile', [App\Http\Controllers\Api\AuthController::class, 'userProfile']);
    Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::apiResource('users', App\Http\Controllers\api\UserController::class);
    Route::get('pqr/export', [App\Http\Controllers\api\PQRController::class, 'export']);
    Route::get('pqr/user', [App\Http\Controllers\api\PQRController::class, 'indexPqrForUser']);
    Route::put('pqr/{pqr}/change-status', [App\Http\Controllers\api\PQRController::class, 'changeStatus']);
    Route::apiResource('pqr', App\Http\Controllers\api\PQRController::class);
});
