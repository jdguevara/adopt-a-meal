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

Route::get('/', 'LandingPageController@index');
Route::post('/form/submit', 'VolunteerFormController@submit');

Auth::routes();
Route::post('/admin/formreview', 'AdminController@submit');
Route::get('/admin', 'AdminController@index')->name('home');

