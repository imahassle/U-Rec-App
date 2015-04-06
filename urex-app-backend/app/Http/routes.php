<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'api'], function() {
    $restExceptions = ['except' => ['create', 'edit']];
    Route::post('login', 'AuthController@login');
    Route::resource(
        'announcement',
        'AnnouncementController',
        $restExceptions
    );
    Route::resource(
        'category',
        'CategoryController',
        $restExceptions
    );
    Route::resource(
        'event',
        'EventController',
        $restExceptions
    );
    Route::resource(
        'feedback',
        'FeedbackController',
        $restExceptions
    );
    Route::resource(
        'hour',
        'HourController',
        $restExceptions
    );
    Route::resource(
        'hours_exception', 
        'HoursExceptionController', 
        $restExceptions
    );
    Route::resource(
        'image', 
        'ImageController', 
        $restExceptions
    );
    Route::resource(
        'incentive_program', 
        'IncentiveProgramController', 
        $restExceptions
    );
    Route::resource(
        'item_rental', 
        'ItemRentalController', 
        $restExceptions
    );
    Route::resource(
        'user', 
        'UserController', 
        $restExceptions
    );
});
