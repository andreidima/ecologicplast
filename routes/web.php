<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProgramareController;
use App\Http\Controllers\MesajTrimisSmsController;
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

    Route::get('programari/afisare-calendar', [ProgramareController::class, 'index'])->name('programari.afisareCalendar');
    Route::resource('/programari', ProgramareController::class,  ['parameters' => ['programari' => 'programare']]);

    Route::resource('mesaje-trimise-sms', MesajTrimisSmsController::class,  ['parameters' => ['mesaje_trimise_sms' => 'mesaj_trimis_sms']]);
});

