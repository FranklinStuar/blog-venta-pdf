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

Route::get('/','HomeController@index')->name('home');
Auth::routes();

Route::group(['prefix' => 'neuro-admin','middleware' => ['auth']], function() {
	Route::get('/', 'HomeController@admin')->name('admin');
	Route::resource('/users','UsersController');
	Route::get('/posts/{id}/pdf-view','PostsController@viewPDF')->name('posts.pdf-view');
	Route::resource('/posts','PostsController');
	Route::resource('/roles','RolesController');
	Route::post('roles/add-permission/{role_id}', 'RolesController@addPermission')->name('role.add-permission');
	Route::post('roles/quit-permission/{role_id}', 'RolesController@quitPermission')->name('role.quit-permission');
	Route::resource('/categories','CategoriesController');
});
Route::get('search','HomeController@search')->name('search');
Route::get('categoria/{category}','HomeController@showCategory')->name('show-category');

Route::get('{post_name}','HomeController@showPost')->name('show-post');
Route::get('{post_name}/book','HomeController@showPDF')->name('show-pdf');
Route::get('/init', 'InitController@index')->name('init');
