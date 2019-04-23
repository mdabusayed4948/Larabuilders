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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware'=>['auth']], function (){



});

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function (){

    Route::get('dashboard','DashboardController@index')->name('dashboard');

    Route::get('settings','SettingsController@index')->name('settings');

    Route::put('profile-update','SettingsController@updateProfile')->name('profile.update');

    Route::put('password-update','SettingsController@updatePassword')->name('password.update');


    Route::resource('banner','BannerController');

    Route::resource('brand','BrandController');

    Route::resource('client','ClientController');

    Route::resource('news','NewsController');

    Route::resource('management','ManagementController');

    Route::resource('product','ProductController');

    Route::resource('career','CareerController');

    Route::resource('photo','PhotoController');

    Route::delete('media/{id}', 'PhotoController@destroymedia')->name('media.destroy');

    Route::resource('media','MediaController');


    Route::post('photo/upload/{photoId}','PhotoController@uploadImage')->name('photo.upload');


});

Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']],function (){

    Route::get('dashboard','DashboardController@index')->name('dashboard');

});




