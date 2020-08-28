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

    Route::resource('/obat','ObatController');
    Route::get('/obat/data/getData','ObatController@getData');

    Route::resource('/apotik','ApotikController');
    Route::get('/apotik/data/getData','ApotikController@getData');

    Route::resource('/pengguna','UserController');
    Route::get('/pengguna/data/getData','UserController@getData');

    Route::resource('/rujukan','RujukanController');
    Route::prefix('/rujukan/data')->group(function (){
        Route::get('/getData','RujukanController@getData');
        Route::post('/acc','RujukanController@acc');
        Route::post('/cetak','RujukanController@cetak');
    });

    Route::resource('/kartu-berobat','KartuBerobatController');
    Route::prefix('/kartu-berobat/data')->group(function (){
        Route::get('/getData','KartuBerobatController@getData');
        Route::post('/cetak','KartuBerobatController@cetak');
    });

});

Route::resource('/antrian','AntrianController');
Route::post('/antrian/simpan','AntrianController@simpan')->name('antrian.simpan');
Route::get('/getPasien','ApiController@getPasien');
Route::get('/getPoli','ApiController@getPoli');
Route::post('/generateCode','ApiController@generateCode');
Route::get('/getRekamMedis','ApiController@getRekamMedis');

Route::resource('/login','LoginController');
Route::resource('/register','RegisterController');

Route::post('/logout','LoginController@logout')->name('logout');


