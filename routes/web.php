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

Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('tasks', 'TasksController');

Route::resource('customers', 'CustomerController');

Route::resource('contacts', 'ContactsController');

Route::get('/search', 'CustomerController@search');

Route::get('/find', 'ContactsController@find');

Route::get('tasks/create/{id}', 'TasksController@customerCreate');

Route::post('tasks/store/{id}', 'TasksController@customerStore');

Route::get('contacts/showcontacts/{id}', 'ContactsController@showContacts');

Route::get('contacts/create/{id}', 'ContactsController@customerCreate');

Route::post('contacts/store/{id}', 'ContactsController@customerStore');

Route::get('contacts/advancedsearch/{id}', 'ContactsController@advancedSearch');