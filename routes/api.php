<?php

use Illuminate\Http\Request;

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
//Route::middleware('auth:api')->get('/api/confirmhao', function (Request $request) {
//
//    return view('queren')->with(['red'=>\Illuminate\Support\Facades\Input::get('red'),
//        'blue'=>\Illuminate\Support\Facades\Input::get('blue'),
//        'beishu'=>\Illuminate\Support\Facades\Input::get('beishu')]);
//});
//Route::middleware('auth:api')->get('/api/confirmhao', 'ShopController@querenhao');