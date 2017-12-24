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


Route::middleware('jwt.auth')->group(function () {
    Route::get('/trees', "TreeController@getTrees");
    Route::post('/trees', "TreeController@createTree");
    Route::get('/trees/{tree}', "TreeController@getTree");
    Route::post('/trees/{tree}', "TreeController@modifyTree");
    Route::delete('/trees/{tree}', "TreeController@deleteTree");
});


Route::prefix('auth')->group(function () {
    Route::post('register', 'UserController@postRegister');
    Route::post('gettoken', 'JWTAuthController@authenticate');
    Route::get('getuser', 'JWTAuthController@getUser');
});

Route::prefix('public')->group(function () {
    Route::get('statistics', 'StatisticsController@getStatistics');
});

