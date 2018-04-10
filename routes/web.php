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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/iamshop', 'ShopController@becomeshop')->name('beshop');
//Route::get('/', 'HomeController@getHome');
Route::post('upload', 'HomeController@postUpload');
Route::post('crop', 'HomeController@postCrop');
Route::post('postshop', 'ShopController@postShop');
Route::get('/personalshop', 'ShopController@personalshop')->name('personalshop');
Route::get('/emotions', 'ShopController@emotions')->name('emotions');
