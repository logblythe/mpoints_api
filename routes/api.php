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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('email/verify/{id}', 'VerificationApiController@verify')->name('verificationapi.verify');

Route::get('email/resend', 'VerificationApiController@resend')->name('verificationapi.resend');


Route::post('login', 'UsersApiController@login');

Route::post('register', 'UsersApiController@register');

Route::group(['middleware' => ['auth:api', 'check_role']], function () {

    Route::get('details', 'UsersApiController@details')->middleware('verified');

    Route::post('setImage', 'UsersApiController@setImage');

    Route::prefix('partners')->group(function () {
        Route::get('/', [
            'uses' => 'PartnerController@index',
            'roles' => ['Admin', 'Seller', 'User'],
        ]);
        Route::get('/{partner}', [
            'uses' => 'PartnerController@show',
            'roles' => ['Admin', 'Seller', 'User']
        ]);
        Route::post('/', [
            'uses' => 'PartnerController@store',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::put('/{partner}', [
            'uses' => 'PartnerController@update',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::delete('/{partner}', [
            'uses' => 'PartnerController@delete',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::get('/{partner}/category', [
            'uses' => 'PartnerController@category',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::get('/{partner}/tags', [
            'uses' => 'PartnerController@tags',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::get('/{partner}/rewards', [
            'uses' => 'PartnerController@rewards',
            'roles' => ['Admin', 'Seller']
        ]);
    });

    Route::prefix('rewards')->group(function () {
        Route::get('/', [
            'uses' => 'RewardController@index',
            'roles' => ['Admin', 'Seller', 'User'],
        ]);
        Route::get('/{reward}', [
            'uses' => 'RewardController@show',
            'roles' => ['Admin', 'Seller', 'User']
        ]);
        Route::post('/', [
            'uses' => 'RewardController@store',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::put('/{reward}', [
            'uses' => 'RewardController@update',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::delete('/{reward}', [
            'uses' => 'RewardController@delete',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::get('/{reward}/category', [
            'uses' => 'RewardController@category',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::get('/{reward}/partner', [
            'uses' => 'RewardController@partner',
            'roles' => ['Admin', 'Seller']
        ]);
    });

    Route::prefix('statements')->group(function () {
        Route::get('/', [
            'uses' => 'StatementController@index',
            'roles' => ['Admin', 'Seller', 'User'],
        ]);
        Route::get('/{statement}', [
            'uses' => 'StatementController@show',
            'roles' => ['Admin', 'Seller', 'User']
        ]);
        Route::post('/', [
            'uses' => 'StatementController@store',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::put('/{statement}', [
            'uses' => 'StatementController@update',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::delete('/{statement}', [
            'uses' => 'StatementController@delete',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::get('/{statement}/category', [
            'uses' => 'StatementController@category',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::get('/{statement}/partner', [
            'uses' => 'StatementController@partner',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::get('/{statement}/reward', [
            'uses' => 'StatementController@reward',
            'roles' => ['Admin', 'Seller']
        ]);
        Route::get('/{statement}/type', [
            'uses' => 'StatementController@transactionType',
            'roles' => ['Admin', 'Seller']
        ]);
    });

});
// will work only when user has verified the email

