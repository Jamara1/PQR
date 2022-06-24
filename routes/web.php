<?php

use App\Mail\PQRExpiredMailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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


Route::group(['middleware' => ['auth']], function () {
    /* Users */
    Route::resource('usuarios', App\Http\Controllers\UserController::class);


    /* PQR */
    Route::get('pqr/usuario', [App\Http\Controllers\PQRController::class, 'indexPqrForUser'])->name('pqr.index.user');
    Route::put('pqr/{pqr}/cambiar-estado', [App\Http\Controllers\PQRController::class, 'changeStatus'])->name('pqr.change.status');
    Route::resource('pqr', App\Http\Controllers\PQRController::class);

    /* Export PQR in Excel */
    Route::get('pqr/exportar', [App\Http\Controllers\PQRController::class, 'export'])->name('pqr.export');

    /* Password */
    Route::get('password/{usuario}/editar', [App\Http\Controllers\PasswordController::class, 'edit'])->name('password.edit');
    Route::put('password/{usuario}', [App\Http\Controllers\PasswordController::class, 'update'])->name('password.update');
});

Route::get('pqr-expired', function() {
    $email = new PQRExpiredMailable();
    Mail::to('7.6amarajohan@gmail.com')->send($email);

    return "Message send";
});
