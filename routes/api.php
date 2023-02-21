<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\DonationRequestController;

use App\Mail\sendMail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/home', function () {
    return view('welcome');
});

# Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class,  'login']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/create-new-password', [AuthController::class, 'createNewPassword']);

// scope
// load()

/**
* Code Review [Results]
 * Code Replication - other side use many-to-many methods.
 * Naming Conventions
 * The way of dealing with passwords
 * Don't Query Builder but ORM
 * Take care of how tables are being stored with data [$fillable vs $hidden]
 * Auto add Notifications when creating donation_request
 *
 */

Route::get('cities', [MainController::class, 'cities']);
Route::get('settings', 'Api\MainController@settings');
Route::get('categories', 'Api\MainController@categories');
Route::get('governorates', 'Api\MainController@governorates');
// auth = middleware
// api  = guard
Route::group(['middleware'=>'auth:api'], function(){
    # Finished
    Route::post('/profile', 'Api\AuthController@profile');
    Route::post('/register-token', 'Api\AuthController@registerToken');
    Route::post('/remove-token', 'Api\AuthController@removeToken');

    # Notifications
    Route::post('/notifications', 'Api\NotificationController@notifications');
    Route::post('/view-notifications-settings', 'Api\NotificationController@viewNotificationsSettings');
    // use PUT here
    Route::post('/update-notifications-settings', 'Api\NotificationController@updateNotificationsSettings');

    # Posts
    Route::post('/list-favorites', 'Api\PostController@listFavorites');
    Route::post('/toggle-favorite', 'Api\PostController@toggleFavorite');

    # Donation Requests
    Route::post('/create-new-donation-request', 'Api\DonationRequestController@createNewDonationRequest');

});

# Donation Requests
Route::post('/view-donation-requests', 'Api\DonationRequestController@viewDonationRequests');
Route::get('/view-one-donation-request/{id}', 'Api\DonationRequestController@viewOneDonationRequest');

# Posts
Route::post('/view-posts', 'Api\PostController@viewPosts');
Route::get('/view-one-post/{id}', 'Api\PostController@viewOnePost');

//Route::apiResources();
Route::post('/attachClientBloodType', 'Api\NotificationController@attachClientBloodType');





