<?php

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


Route::get('/', 'MainController@showEmployees');
Route::get('/table', 'MainController@index');
Route::get('/showChart', 'MainController@showChart');
Route::get('/showSalary', 'MainController@showSalary');
Route::get('/countGender', 'MainController@countGender');
Route::get('/amountTitles', 'MainController@amountTitles');
Route::resource('employee', 'MainController');
Route::get('/getEmployee', 'MainController@getEmployee')->name('employees');