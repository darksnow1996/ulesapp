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

Route::get('/', 'Auth\LoginController@showLoginForm' );
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

/*Route::post('/login', 'Auth\LoginController@authenticate');*/

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	Route::put('/profile/picture', array('as' =>'profile.picture', 'uses'=>'ProfileController@pictures'));
	Route::get('/transactions', array('as' =>'transaction.list','uses' => 'TransactionController@showtransactions'));
	Route::get('/pay',array('as' => 'pay.index', 'uses' => 'PaymentController@index'));
    Route::get('/payment',array('as' => 'pay.pay', 'uses' => 'PaymentController@makepayment'));
    Route::post('/pay', [
        'uses' => 'PaymentController@redirectToGateway',
        'as' => 'pay'
    ]);
    Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
    Route::post('/fee', 'PaymentController@getfee');
	Route::get('/test',function (){
	    $user = \Illuminate\Support\Facades\Auth::user()->firstname;
	    var_dump($user);
    });


});

