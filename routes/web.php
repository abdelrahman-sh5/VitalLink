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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/**
 * add "SelectAll" button in edit_user, edit_role
 * add "DeleteAll" button in every page in the entire project.
 *
 * what is new static
 * TRY THIS throw className::staticMethod();
 */

Route::prefix('admin')->middleware('auth:web')->group(function (){
    Route::get('main', function () { return view('admin.main'); });
    Route::get('home', function () { return view('admin.home'); });
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



Route::get('/home', 'HomeController@index')->name('home');
