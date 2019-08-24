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
Route::get('email/verify/{id}', 'VerificationApiController@verify')->name('verificationapi.verify');

Route::get('email/resend', 'VerificationApiController@resend')->name('verificationapi.resend');

Route::post('login', ['as' => 'login',
    'uses' => 'UsersApiController@login']);

Route::post('register', 'UsersApiController@register');

Route::post('register/email', 'UsersApiController@uniqueEmail');

Route::post('password/reset', 'UsersApiController@resetPassword');

Route::get('utility', 'UsersApiController@utility');

Route::group(['middleware' => ['auth:api', 'check_role']], function () {

    Route::get('details', ['uses' => 'UsersApiController@details',
        'roles' => ['Admin', 'Seller', 'User']]);

    Route::post('updatePassword', ['uses' => 'UsersApiController@updatePassword',
        'roles' => ['Admin', 'Seller', 'User']]);

    Route::post('setImage', 'UsersApiController@setImage');

    Route::get('ads', ['uses' => 'AdController@index',
        'roles' => ['Admin', 'Seller', 'User']
    ]);

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
            'roles' => ['Admin', 'Seller', 'User']
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

    Route::prefix('sellers')->group(function () {
        Route::get('/', [
            'uses' => 'SellerController@show',
            'roles' => ['Admin', 'Seller', 'User']
        ]);
    });
    Route::prefix('partnerSellers')->group(function () {
        Route::get('/', [
            'uses' => 'PartnerSellerController@show',
            'roles' => ['Admin', 'Seller', 'User']
        ]);

    });

    Route::prefix('employees')->group(function () {
        Route::get('/isPartnerEmp', [
            'uses' => 'EmployeeController@isPartnerEmp',
            'roles' => ['Admin', 'Seller', 'User']
        ]);
    });
});
// will work only when user has verified the email

