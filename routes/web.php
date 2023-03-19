<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClientController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

/**
 * In Admin Dashboard :
 * Add Cookie (Remember Me)
 * add "SelectAll" button in edit_user, edit_role
 * add "DeleteAll" button in every page in the entire project.
 * TRY THIS throw className::staticMethod();
 */

Route::prefix('admin')->middleware('auth:web')->group(function () {
    Route::get('main', function () {
        return view('admin.main');
    });
    Route::get('home', function () {
        return view('admin.home');
    });
    Route::resource('governorates', 'Admin\GovernorateController')->middleware('role:AdminRole1|governorates');
    Route::resource('cities', 'Admin\CityController')->middleware('role:AdminRole1|cities');
    Route::resource('categories', 'Admin\CategoryController')->middleware('role:AdminRole1|categories');
    Route::resource('posts', 'Admin\PostController')->middleware('role:AdminRole1|posts');
    Route::resource('clients', 'Admin\ClientController');
    Route::resource('donations', 'Admin\DonationController');
    Route::resource('contacts', 'Admin\ContactController');
    Route::resource('settings', 'Admin\SettingController');
    Route::resource('roles', 'Admin\RoleController')->middleware('role:AdminRole1');
    Route::resource('users', 'Admin\UserController')->middleware('role:AdminRole1');
});

/*
 * Make profile page - [session profile data is not not synced with in db]
 * Make Ajax call when (toggleFav)
 * Handle favorites and authenticated-accessed pages by middleware
 * Add intro_text in Admin Panel
 * Enhance design and any other stuff
 * */
Route::get('/', 'Client\MainController@index')->name('/');
Route::prefix('auth')->group(function () {
    Route::get('/show-register', 'Client\AuthController@showRegister')->name('show-register');
    Route::post('/client-register', 'Client\AuthController@register')->name('register');

    Route::get('/show-reset-password', 'Client\AuthController@showResetPassword')->name('show-reset-password');
    Route::post('/reset-password', 'Client\AuthController@resetPassword')->name('reset-password');

    Route::get('/show-change-password', 'Client\AuthController@showChangePassword')->name('show-change-password');
    Route::post('/change-password', 'Client\AuthController@changePassword')->name('change-password');

    Route::get('/show-login', 'Client\AuthController@showLogin')->name('show-login');
    Route::post('/client-login', 'Client\AuthController@login')->name('clientLogin');

    Route::get('/profile', 'Client\AuthController@profile')->name('profile');
    Route::put('/update-profile', 'Client\AuthController@updateProfile')->name('update-profile');

    Route::get('/client-logout', 'Client\AuthController@logout')->name('clientLogOut');
});

Route::get('/post/{id}', 'Client\MainController@post')->name('post');
Route::get('/favorites', 'Client\MainController@favorites')->name('favorites');

Route::get('/contact-us', 'Client\MainController@contact')->name('contact-us');
Route::post('/send-contact-details', 'Client\MainController@sendContactDetails');

Route::get('/who-are-us', 'Client\MainController@whoAreUs')->name('who-are-us');
Route::get('/toggle-favorite', 'Client\MainController@toggleFavorite')->name('toggle-favorite');

//Route::resource('authenticate-client', 'Client\AuthController');
Route::resource('/donation-requests', 'Client\DonationController');

Route::get('/home', 'HomeController@index')->name('home');

/*
 * Guzzle HTTP Client sample code
 *
//        $res = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts');
//        echo $res->getStatusCode();                 // "200"
//        echo $res->getHeader('content-type')[0];   // 'application/json; charset=utf8'
//        echo $res->getBody();
 *
 * */
