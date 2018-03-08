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
Route::get('/meal-ideas', 'MealIdeasController@index');

Auth::routes();
Route::get('/admin', 'AdminController@index')->name('home');
Route::post('/admin/form/review', 'AdminController@reviewVolunteerForm');

Route::get('/admin/meal-ideas', 'AdminController@viewMealIdeas');
Route::post('/admin/meal-ideas/review', 'AdminController@reviewMealIdea');

