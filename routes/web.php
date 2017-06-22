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
	Route::get('/premium-sponsor/add-feature','PremiumSponsorsController@addFeature')->name('premium-sponsor.add-feature');
	Route::resource('/premium-sponsor','PremiumSponsorsController');
	Route::post('/premium-sponsor-detail/{premium_id}/add-category','PremiumSponsorsController@addCategory')->name('premium-sponsor.add-category');
	Route::post('/premium-sponsor-detail/{detail_id}/quit-category','PremiumSponsorsController@quitCategory')->name('premium-sponsor.quit-category');
	Route::resource('/sponsors','SponsorsController');
	Route::get('/sponsors/historial/{id}','SponsorsController@historial')->name('sponsors.historial');
	Route::get('/sponsor-pay/{id_pay}','SponsorPaysController@show')->name('sponsor-pays.show');
	Route::get('/sponsor-pay/{id_pay}/active','SponsorPaysController@active')->name('sponsor-pays.active');
	Route::post('/sponsor-pay/{id_pay}','SponsorPaysController@saveActive')->name('sponsor-pays.save-active');
	Route::get('/sponsor-pay/{id_pay}/cancele','SponsorPaysController@cancel')->name('sponsor-pays.cancel');

	Route::get('/config', 'SystemController@config')->name('config');
	Route::post('/config', 'SystemController@saveConfig')->name('config.save');
	Route::get('/historial', 'SystemController@historial')->name('historial');
});


Route::get('/init', 'InitController@index')->name('init');

Route::get('/profile', 'UsersController@profile')->name('profile');
Route::get('/profile/edit', 'UsersController@profileEdit')->name('profile.edit');
Route::post('/profile/edit', 'UsersController@profileSave')->name('profile.save');

Route::get('/publicidad', 'SponsorsController@listUser')->name('sponsor.list');
Route::get('/publicidad/nueva-publicidad', 'SponsorsController@createSponsor')->name('sponsor.create');
Route::post('/publicidad/save-sponsor', 'SponsorsController@sponsorSave')->name('sponsor.save');
Route::get('/publicidad/payment', 'SponsorsController@payment')->name('sponsor.payment');
Route::get('/publicidad/payment-card', 'SponsorsController@makePaymentCard')->name('sponsor.make-payment-card');
Route::get('/publicidad/payment-paypal', 'SponsorsController@makePaymentPaypal')->name('sponsor.make-payment-paypal');
Route::get('/publicidad/editar/{id_sponsor}', 'SponsorsController@editSponsorUser')->name('sponsor.edit-user');
Route::get('/publicidad/{id_sponsor}', 'SponsorsController@showSponsor')->name('sponsor.show-user');
Route::post('/publicidad/{id_sponsor}', 'SponsorsController@saveEdit')->name('sponsor.save-edit');
Route::get('/publicidad/cancelar-pago/{id_sponsor}/{id_payment}', 'SponsorsController@cancelPaySponsor')->name('sponsor.cancel-pay');


Route::get('search','HomeController@search')->name('search');
Route::get('categoria/{category}','HomeController@showCategory')->name('show-category');
Route::get('/usuario/{username}','HomeController@showUser')->name('show-user');
Route::get('{post_name}','HomeController@showPost')->name('show-post');
Route::get('{post_name}/book','HomeController@showPDF')->name('show-pdf');
