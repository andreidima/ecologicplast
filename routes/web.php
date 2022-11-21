<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
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

Auth::routes(['register' => false, 'password.request' => false, 'reset' => false]);

Route::redirect('/', '/acasa');

Route::group(['middleware' => 'auth'], function () {
    Route::view('/acasa', 'acasa');

    Route::resource('/clienti', ClientController::class,  ['parameters' => ['clienti' => 'client']]);

    Route::get('/schimbare-parola', [UserController::class, 'schimbareParola'])->name('schimbare_parola');
    Route::post('/schimbare-parola', [UserController::class, 'actualizareParola'])->name('actualizare_parola');
});

Route::middleware(['role:Administrator'])->group(function () {
    Route::resource('/users', UserController::class);
});

