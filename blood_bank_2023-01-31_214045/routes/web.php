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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('client', 'ClientController');
Route::resource('bloodtype', 'BloodTypeController');
Route::resource('city', 'CityController');
Route::resource('governorate', 'GovernorateController');
Route::resource('post', 'PostController');
Route::resource('category', 'CategoryController');
Route::resource('clientpost', 'ClientPostController');
Route::resource('donationrequest', 'DonationRequestController');
Route::resource('notification', 'NotificationController');
Route::resource('clientnotification', 'ClientNotificationController');
Route::resource('bloodtypeclient', 'BloodTypeClientController');
Route::resource('clientgovernorate', 'ClientGovernorateController');
Route::resource('contact', 'ContactController');
Route::resource('setting', 'SettingController');
