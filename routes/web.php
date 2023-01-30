<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Auth::routes(['register' => false]);
Route::group(array('namespace' => 'Backend', 'middleware' => 'auth'), function () {
    Route::resource('/ringtones', 'RingtoneController');
});
Route::group(array('namespace' => 'Backend', 'middleware' => 'auth'), function () {
    Route::resource('/photos', 'PhotoController');
});
Route::group(array('namespace' => 'Frontend'), function () {
    Route::get('/', 'RingtoneController@index');
    Route::get('/rintones/{id}/{slug}', 'RingtoneController@show')->name('ringtones.show');
    Route::post('/download/{id}', 'RingtoneController@download')->name('ringtones.download');
    Route::get('/category/{id}', 'RingtoneController@category')->name('ringtones.category');
    Route::get('/display', 'PhotoController@wall');
    Route::post('/download1/{id}', 'PhotoController@download1')->name('download1');
    Route::post('/download2/{id}', 'PhotoController@download2')->name('download2');
    Route::post('/download3/{id}', 'PhotoController@download3')->name('download3');
    Route::post('/download4/{id}', 'PhotoController@download4')->name('download4');
});
