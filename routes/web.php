<?php

use Illuminate\Support\Facades\Route;

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

/*File Methods
 * guessExtension() - getMimeType() - store() - asStore() - storePublicly() - move()
 * getClientOriginName() - getClientMimeType() - getClientExtension() -getSize() - getError()
 *  -
 *
 * */

Route::prefix('admin')->group(function (){
    Route::get('main', function () { return view('admin.main'); });
    Route::resource('governorates', 'Admin\governoratesController');
    Route::resource('cities', 'Admin\citiesController');
    Route::resource('categories', 'Admin\categoriesController');
    Route::resource('posts', 'Admin\postsController');
    Route::resource('clients', 'Admin\clientsController');
    Route::resource('donations', 'Admin\donationsController');
    Route::resource('contacts', 'Admin\contactsController');
    Route::resource('settings', 'Admin\settingsController');
});


# ->load() vs ->with()

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
