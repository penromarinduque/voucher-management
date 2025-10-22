<?php

/*
|--------------------------------------------------------------------------
| MAIN Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Mail;

Route::get('/', function () { return view('welcome'); })->name('welcome');

Auth::routes();

Route::group(['middleware' => 'auth'],function() {

	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//  INDEXES
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	// VIEW DASHBOARD
	Route::get('/home', 'denr\HomeController@index')->name('home');

	//DTS INDEX
	Route::get('/dts', 'denr\HomeController@DocumentTrackingSystem')->name('dts');
	
	//TOA INDEX
	Route::get('/toa', 'denr\HomeController@TravelOrderApplication')->name('toa');

	//PIS INDEX
	Route::get('/pis', 'denr\HomeController@PersonalInformation')->name('pis');

	//APP INDEX
	Route::get('/app', 'denr\HomeController@SystemUtilities')->name('app');

	//LMS INDEX
	Route::get('/lms', 'denr\HomeController@LeaveMonitoring')->name('lms');

	//LMS INDEX
	Route::get('/fsa', 'denr\HomeController@FrontlineServices')->name('fsa');

	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	//  MY ACCOUNT
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

	// VIEW MY ACCOUNT
	Route::get('/{path}/my_account/myaccount', 'denr\my_account\AccountController@ViewAccount')->name('user.account');

	// POST MY ACCOUNT FORM 
	Route::post('/{path}/my_account/editmyaccount', 'denr\my_account\AccountController@EditAccount')->name('user.account.submit');

	// VIEW CHANGE PASSWORD FORM
	Route::get('/{path}/my_account/changepassword', 'denr\my_account\PasswordController@ViewPassword')->name('change.password');

	// POST CHANGE PASSWORD FORM 
	Route::post('/{path}/my_account/changepassword', 'denr\my_account\PasswordController@ChangePassword')->name('change.password.submit');

	// VIEW MY AUDIT LOG FORM
	Route::get('/{path}/my_account/myaudittraillog', 'denr\my_account\MyAuditTrailController@ShowMyAuditForm')->name('my.audit.trail.log.form');

	// POST MY AUDIT LOG FORM
	Route::post('/{path}/my_account/filtermyaudittraillog', 'denr\my_account\MyAuditTrailController@FilterMyAudit')->name('my.audit.trail.log.filter');

});

