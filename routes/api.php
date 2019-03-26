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

Route::group([
    'prefix' => 'users',
], function () {
    Route::post('/', 'UserController@create')
        ->name('users.create');

    Route::get('self', 'UserController@self')
        ->name('users.self');

    Route::get('{user}', 'UserController@show')
        ->name('users.show')
        ->middleware('can:view,user');

    Route::delete('{user}', 'UserController@destroy')
        ->name('users.destroy')
        ->middleware('can:delete,user');
});

Route::group([
    'prefix' => 'recommendation',
], function () {
    Route::post('/', 'CreateRecommendationController')
        ->name('recommendation.create');
});