<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClientsController;

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
//Route::group(['middleware'=>'auth'], function(){
    Route::get('/admin/home', function () {
        return view('admin.home');
    });
//});


Route::prefix('admin')->middleware('auth:web')->group(function (){
    Route::get('main', function () { return view('admin.main'); });
    Route::resource('governorates', 'Admin\GovernoratesController');
    Route::resource('cities', 'Admin\CitiesController');
    Route::resource('categories', 'Admin\CategoriesController');
    Route::resource('posts', 'Admin\PostsController');
    Route::resource('clients', 'Admin\ClientsController');
    Route::resource('donations', 'Admin\DonationsController');
    Route::resource('contacts', 'Admin\ContactsController');
    Route::resource('settings', 'Admin\SettingsController');
});


# ->load() vs ->with()

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
