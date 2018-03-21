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

Route::get('/', 'LandingPageController@index')->name('home');
Route::get('/meal-ideas', 'MealIdeasController@index')->name('mealideas');

Auth::routes();
Route::get('/admin', 'AdminController@index')->name('admin-home');
Route::get('/admin/form/all', 'AdminController@viewVolunteerFormsTable')->name('admin-volunteerforms-table');
Route::post('/admin/form/review', 'AdminController@reviewVolunteerForm');

Route::get('/admin/meal-ideas', 'AdminController@viewMealIdeas')->name('admin-mealideas');
Route::get('/admin/meal-ideas/all', 'AdminController@viewMealIdeasTable')->name('admin-mealideas-table');
Route::post('/admin/meal-ideas/review', 'AdminController@reviewMealIdea');

Route::get('/admin/settings/change-messages', 'AdminController@getMessages');
Route::post('/admin/settings/update-message', 'AdminController@updateMessage');

