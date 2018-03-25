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
Route::post('/admin/form/approve', 'AdminController@approveVolunteer');
Route::post('/admin/form/deny', 'AdminController@denyVolunteer');
Route::post('/admin/form/cancel', 'AdminController@cancelConfirmedEvent');
Route::post('/admin/form/update', 'AdminController@updateVolunteer');

Route::get('/admin/meal-ideas', 'AdminController@viewMealIdeas')->name('admin-mealideas');
Route::get('/admin/meal-ideas/all', 'AdminController@viewMealIdeasTable')->name('admin-mealideas-table');
Route::post('/admin/meal-ideas/review', 'AdminController@updateMealIdea');
Route::post('/admin/meal-ideas/approve', 'AdminController@approveMealIdea');
Route::post('/admin/meal-ideas/deny', 'AdminController@denyMealIdea');

Route::get('/admin/settings/change-messages', 'AdminController@getMessages');
Route::post('/admin/settings/update-message', 'AdminController@updateMessage');

