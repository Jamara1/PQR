<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});

Auth::routes();

Route::get('/inicio', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('usuarios', App\Http\Controllers\UserController::class);
    Route::resource('pqr', App\Http\Controllers\PQRController::class);
    Route::put('pqr/{pqr}/change-status', [App\Http\Controllers\PQRController::class, 'changeStatus'])->name('pqr.change.status');
});
