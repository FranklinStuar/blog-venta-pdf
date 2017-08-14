<?php

Route::get('/','HomeController@index')->name('home');
Route::get('/welcome','HomeController@welcome')->name('home');
Route::get('/send-email',function(){
	\Auth::user()->sendWelcome('123');
	return redirect()->back();
})->name('send-email');
Auth::routes();

Route::group(['prefix' => 'neuro-admin','middleware' => ['auth']], function() {
	Route::get('/', 'HomeController@admin')->name('admin');
	Route::resource('/users','UsersController');
	Route::get('/posts/pdf-view/{pdf_id}','PostsController@viewPDF')->name('posts.pdf-view');
	Route::post('/posts/{post_id}/price','PostsController@storePrice')->name('posts.store-price');
	Route::post('/posts/{post_id}/price/{price}/update','PostsController@updatePrice')->name('posts.update-price');
	Route::delete('/posts/{post_id}/price/{price}/destroy','PostsController@destroyPrice')->name('posts.destroy-price');
	
	Route::post('/posts/{post_id}/update-image','PostsController@updateImage')->name('posts.update-image');
	Route::post('/posts/{post_id}/add-pdf','PostsController@addPdf')->name('posts.add-pdf');
	Route::post('/posts/{post_id}/destroy-pdf/{pdf_id}','PostsController@destroyPdf')->name('posts.destroy-pdf');
	Route::post('/posts/{post_id}/add-zip','PostsController@addZip')->name('posts.add-zip');
	Route::post('/posts/{post_id}/destroy-zip/{zip_id}','PostsController@destroyZip')->name('posts.destroy-zip');
	Route::post('/posts/get-once-prices','PostsController@getOncePrices')->name('posts.get-once-prices');
	Route::post('/posts/get-once-prices/detail','PostOncePricesController@getDetail')->name('posts.get-detail-once-prices');

	Route::get('/posts/{post_id}/view-kit','PostsController@viewKits')->name('posts.view-kit');
	Route::resource('/posts','PostsController');
	Route::resource('/roles','RolesController');
	Route::post('roles/add-permission/{role_id}', 'RolesController@addPermission')->name('role.add-permission');
	Route::post('roles/quit-permission/{role_id}', 'RolesController@quitPermission')->name('role.quit-permission');
	Route::get('roles/show-posts/{role_id}', 'RolesController@showPosts')->name('role.show-posts');

	Route::resource('/categories','CategoriesController');
	Route::post('/premium-sponsor/get-detail','PremiumSponsorsController@getDetail')->name('premium-sponsor.get-detail');
	Route::get('/premium-sponsor/add-feature','PremiumSponsorsController@addFeature')->name('premium-sponsor.add-feature');
	Route::resource('/premium-sponsor','PremiumSponsorsController');
	Route::post('/premium-sponsor-detail/{premium_id}/add-category','PremiumSponsorsController@addCategory')->name('premium-sponsor.add-category');
	Route::post('/premium-sponsor-detail/{detail_id}/quit-category','PremiumSponsorsController@quitCategory')->name('premium-sponsor.quit-category');

	Route::post('premium-post/add-detail/{premium_id}','PremiumPostsController@addDetail')->name('premium-post.add-detail');
	Route::post('premium-post/quit-detail/{premium_id}','PremiumPostsController@quitDetail')->name('premium-post.quit-detail');
	Route::post('premium-post/get-detail','PremiumPostsController@getDetail')->name('premium-post.get-detail');
	Route::get('/premium-post/{kit_id}/view-post','PremiumPostsController@viewPosts')->name('premium-post.view-post');
	Route::delete('/premium-post/{kit_id}/kit/{post_id}','PremiumPostsController@destroyPosts')->name('premium-post.destroy-post');
	Route::post('/premium-post/{kit_id}/kit','PremiumPostsController@addPosts')->name('premium-post.add-post');
	Route::resource('premium-post','PremiumPostsController');

	Route::resource('pay-post', 'PostPaysController');
	
	Route::post('only-pay-post/{pay_id}/get','PostOncePaysController@getShow')->name('posts-once-pay.get');
	Route::resource('only-pay-post', 'PostOncePaysController');

	Route::resource('/sponsors','SponsorsController');
	Route::get('/sponsors/historial/{id}','SponsorsController@historial')->name('sponsors.historial');
	Route::post('/sponsor-pay','SponsorPaysController@store')->name('sponsor-pays.store');
	Route::get('/sponsor-pay/create/{sponsor_id}/{user_id}','SponsorPaysController@create')->name('sponsor-pays.create');
	Route::get('/sponsor-pay/{id_pay}','SponsorPaysController@show')->name('sponsor-pays.show');
	Route::get('/sponsor-pay/{id_pay}/active','SponsorPaysController@active')->name('sponsor-pays.active');
	Route::post('/sponsor-pay/{id_pay}','SponsorPaysController@saveActive')->name('sponsor-pays.save-active');
	Route::get('/sponsor-pay/{id_pay}/cancele','SponsorPaysController@cancel')->name('sponsor-pays.cancel');

	Route::get('/config', 'SystemController@config')->name('config');
	Route::post('/config', 'SystemController@saveConfig')->name('config.save');
	Route::post('/config-google', 'SystemController@saveGoogleConfig')->name('config-google.save');
	Route::get('/historial', 'SystemController@historial')->name('historial');
});

Route::group(['middleware' => ['auth']], function() {
	Route::get('/profile', 'UsersController@profile')->name('profile');
	Route::get('/profile/edit', 'UsersController@profileEdit')->name('profile.edit');
	Route::post('/profile/edit', 'UsersController@profileSave')->name('profile.save');
	Route::post('/profile/reset-password', 'UsersController@profileSavePassword')->name('profile.reset-password');

	Route::get('/publicidad', 'SponsorsController@listUser')->name('sponsor.list');
	Route::get('/publicidad/nueva-publicidad', 'SponsorsController@createSponsor')->name('sponsor.create');
	Route::post('/publicidad/save-sponsor', 'SponsorsController@sponsorSave')->name('sponsor.save');
	Route::get('/publicidad/payment', 'SponsorsController@payment')->name('sponsor.payment');
	Route::get('/publicidad/payment-card', 'SponsorsController@makePaymentCard')->name('sponsor.make-payment-card');
	Route::get('/publicidad/payment-paypal/{sponsor_id}/{price_id}', 'SponsorsController@paymentPaypal')->name('sponsor.make-payment-paypal');
	Route::get('/publicidad/payment-paypal', 'SponsorsController@makePaymentPaypal')->name('sponsor.complete-payment-paypal');
	Route::get('/publicidad/editar/{id_sponsor}', 'SponsorsController@editSponsorUser')->name('sponsor.edit-user');
	Route::get('/publicidad/{id_sponsor}', 'SponsorsController@showSponsor')->name('sponsor.show-user');
	Route::post('/publicidad/{id_sponsor}', 'SponsorsController@saveEdit')->name('sponsor.save-edit');
	Route::get('/publicidad/cancelar-pago/{id_sponsor}/{id_payment}', 'SponsorsController@cancelPaySponsor')->name('sponsor.cancel-pay');

	Route::get('{post_id}/pago/{pago_id}','PostsController@payments')->name('post.payments');
	Route::get('{post_id}/pago/{pago_id}/paypal','PostsController@paymentPaypal')->name('post.payment-paypal');
	Route::get('post/paypal/payment-complete','PostsController@paypalPaymentComplete')->name('post.paypal-payment-complete');
	Route::post('{post_id}/pago/{pago_id}/card','PostsController@paymentCard')->name('post.payment-card');
	Route::post('payment/paypal','PostsController@makePaymentPaypal')->name('post.make-payment-card');
	Route::post('payment/card','PostsController@makePaymentCard')->name('post.make-payment-card');
});



Route::get('/init', 'InitController@index')->name('init');
Route::get('/free', 'HomeController@free')->name('post.free');
Route::get('search','HomeController@search')->name('search');
Route::get('categoria/{category}','HomeController@showCategory')->name('show-category');
Route::get('{category}','HomeController@showCategory')->name('show-service');
Route::get('/usuario/{username}','HomeController@showUser')->name('show-user');
Route::get('/autor/{username}','HomeController@showUser')->name('show-author');
// Route::get('{post_name}','HomeController@showPost')->name('show-post');
Route::get('{service}/{post_name}','HomeController@showPost')->name('show-post');
Route::get('{service}/{post_name}/leer-gratis/{book_name}','HomeController@showFreePDF')->name('free-pdf');
Route::get('{service}/{post_name}/leer/{book_name}/{pdf_id}','HomeController@showPDF')->name('show-pdf');
Route::get('{service}/{post_name}/{zip_id}/download','HomeController@downloadZip')->name('download-zip');



