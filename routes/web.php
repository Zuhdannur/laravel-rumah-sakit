<?php

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


Route::group(['middleware' => 'auth:web'] , function () {
    Route::resource('/', 'HomeController');

    Route::resource('/pasien','PasienController');
    Route::get('/pasien/data/getData','PasienController@getData');

    Route::resource('/dokter','DokterController');
    Route::get('/dokter/data/getData','DokterController@getData');

    Route::resource('/rekam-medis','RekamMedisController');
    Route::get('/rekam-medis/data/getData','RekamMedisController@getData');

    Route::resource('/poli','PoliController');
    Route::get('/poli/data/getData','PoliController@getData');


    Route::get('/getDokter','ApiController@getDokter');
    Route::post('/call-antrian/{id}','AntrianController@callAntrian');
});

Route::resource('/antrian','AntrianController');
Route::get('/getPasien','ApiController@getPasien');
Route::get('/getPoli','ApiController@getPoli');

Route::resource('/login','LoginController');
Route::resource('/register','RegisterController');

Route::post('/logout','LoginController@logout')->name('logout');


