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

Route::get('/', 'LandingController@landingPage')->name('/');
Route::get('/search', 'LandingController@searchCars')->name('search.car');

// Auth::routes();
// Authentication Routes...
Route::get('login', [
  'as' => 'login',
  'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
  'as' => '',
  'uses' => 'Auth\LoginController@loginn'
]);
Route::post('logout', [
  'as' => 'logout',
  'uses' => 'Auth\LoginController@logout'
]);

// Password Reset Routes...
Route::post('password/email', [
  'as' => 'password.email',
  'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
  'as' => 'password.request',
  'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
  'as' => 'password.update',
  'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
  'as' => 'password.reset',
  'uses' => 'Auth\ResetPasswordController@showResetForm'
]);

// Registration Routes...
Route::get('register', [
  'as' => 'register',
  'uses' => 'Auth\RegisterController@showRegistrationForm'
]);
Route::post('register', [
  'as' => '',
  'uses' => 'Auth\RegisterController@register'
]);

// Route::get('/register/paypal-payment/{$user_id}', 'Auth\RegisterController@showPaypal')->name('show.paypal');
Route::post('/user/create', 'Auth\RegisterController@store')->name('register2');

Route::get('/home', 'HomeController@index')->name('home');

// item routes
Route::get('/items', 'ItemController@index')->name('item.index');
Route::get('/item/create', 'ItemController@create')->name('item.create');
Route::post('/item/create', 'ItemController@store')->name('item.store');
Route::get('/item/{product_id}', 'ItemController@show')->name('item.show');
Route::get('/item/edit/{product_id}', 'ItemController@edit')->name('item.edit');
Route::post('/item/edit/{product_id}/{id}', 'ItemController@update')->name('item.update');
Route::get('/item_details/{product_id}', 'ItemController@details')->name('item.details');
Route::delete('/item/{id}/delete', 'ItemController@destroy')->name('item.destroy');

// load bid
Route::get('/item/{id}/bid', 'ItemController@loadBid');

// storebid
Route::post('/item/{id}/bid/store', 'ItemController@storeBid')->name('store.bid');


// admin item routes
Route::get('/admin/products', 'Admin\ItemController@index')->name('product.index');
Route::get('/admin/pending', 'Admin\ItemController@pendingIndex')->name('pending.product.index');
Route::get('/admin/declined', 'Admin\ItemController@declinedIndex')->name('declined.product.index');
Route::get('/admin/product/{product_id}', 'Admin\ItemController@show')->name('product.show');
Route::get('/admin/product/edit/{product_id}', 'Admin\ItemController@edit')->name('product.edit');
Route::post('/admin/product/edit/{product_id}/{id}', 'Admin\ItemController@update')->name('product.update');
Route::get('/admin/product/{product_id}/approve', 'Admin\ItemController@approveProduct')->name('product.approve');
Route::get('/admin/product/{product_id}/decline', 'Admin\ItemController@declineProduct')->name('product.decline');

// admin user routes
Route::get('/admin/users', 'Admin\UserController@index')->name('user.index');
Route::get('/admin/user/{id}', 'Admin\UserController@show')->name('user.show');

// admin chat routes
Route::get('insertadminchat', 'AdminChatController@submitChat');

// load chats
Route::get('adminchats/{user_id}/{admin_id}', 'AdminChatController@chats');

// user chat routes
Route::get('/viewchat', 'AdminChatController@userViewChat')->name('user.view.chat');
Route::get('insertuserchat', 'AdminChatController@submitUserChat');

// user account routes
Route::get('/account-information','UserAccountController@show')->name('account-information.show');
Route::post('/account-information','UserAccountController@update')->name('account-information.update');
Route::get('/account-password','UserAccountController@password')->name('account.password');
Route::post('/account-password','UserAccountController@updatePassword')->name('account.password.update');

// bid routes
Route::post('item/{id}/bid', 'BidController@store')->name('bid.store');

// inbox routes
Route::get('/inbox/compose', 'InboxController@compose')->name('inbox.compose');
Route::get('/inbox', 'InboxController@index')->name('inbox.index');
Route::get('/inbox/sent', 'InboxController@sent')->name('inbox.sent');
Route::post('/inbox', 'InboxController@store')->name('inbox.store');
Route::post('/inbox2', 'InboxController@store2')->name('inbox.store2');
// Route::get('/inbox/view', 'InboxController@view')->name('inbox.view');
Route::delete('/inbox/update/{id}', 'InboxController@update')->name('inbox.update');

// payment log routes
Route::get('/admin/payments', 'Admin\PaymentController@index')->name('payment.index');
Route::get('/admin/payment/registration', 'Admin\PaymentController@registration')->name('payment.registration');
Route::get('/admin/payment/posting', 'Admin\PaymentController@posting')->name('payment.posting');

Route::get('tester', 'BidController@tester');

// notification routes
Route::delete('/notification/update/{id}', 'NotificationController@update')->name('notification.update');
Route::delete('/notification2/update/{id}', 'NotificationController@update2')->name('notification.update2');
Route::get('notifications', 'NotificationController@index')->name('notification.index');

// report
// Route::delete('/report/{id}', 'ReportController@store')->name('report.store');
Route::post('/report/store', 'ReportController@store')->name('report.store');
Route::get('/reports', 'Admin\ReportController@index')->name('report.index');

// view car guest
Route::get('/item/p/{product_id}', 'GuestController@showCar')->name('show.car');
