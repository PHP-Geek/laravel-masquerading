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
Route::post('login', 'ApiController@particiantLogin');
Route::group(array('middleware' => 'participantApi'), function() {
     Route::get('/getSession', 'ApiController@getSession');
    
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
