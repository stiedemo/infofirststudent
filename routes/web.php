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

Route::get('/', 'HomeController@redirectHome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create', 'HomeController@create')->name('create');
Route::post('/create', 'HomeController@actionCreate')->name('create');
Route::post('/edit-item/{id}', 'HomeController@actionEditItem')->name('edit_item');
Route::get('/create-item/{id}', 'HomeController@createEditItem')->name('create_item');
Route::get('/download_student_item/{id}', 'HomeController@downloadWordItem')->name('download_student_item');
Route::get('/download_student/{id}', 'HomeController@downloadExcel')->name('download_student_excel');
Route::get('/detail/{hash_code}-{id}', 'HomeController@detail')->name('detail');
Route::get('/edit/{hash_code}-{id}', 'HomeController@edit')->name('edit');
Route::post('/edit/{hash_code}-{id}', 'HomeController@actionEdit')->name('edit');
Route::get('/switch-status/{hash_code}-{id}', 'HomeController@switchStatus')->name('switch_status');
Route::get('/n/{hash_code}', 'FrontendController@writeStudent')->name('write_student');
Route::post('/n/{hash_code}', 'FrontendController@saveWriteStudent')->name('write_student');

Auth::routes();

