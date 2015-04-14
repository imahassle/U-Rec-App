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

    // Login routes
    Route::post('login', 'AuthController@login');

    // Announcement routes
    Route::resource(
        'announcement',
        'AnnouncementController',
        $restExceptions
    );

    // Category routes
    Route::resource(
        'category',
        'CategoryController',
        $restExceptions
    );

    // Event routes
    Route::resource(
        'event',
        'EventController',
        $restExceptions
    );
    Route::get('event/category/{category_id}', 'EventController@index_category');

    // Feedback routes
    Route::resource(
        'feedback',
        'FeedbackController',
        $restExceptions
    );

    // Hour routes
    Route::resource(
        'hour',
        'HourController',
        $restExceptions
    );

    // Hours Exception routes
    Route::resource(
        'hours_exception', 
        'HoursExceptionController', 
        $restExceptions
    );

    // Image routes
    Route::resource(
        'image', 
        'ImageController', 
        $restExceptions
    );

    // Incentive Program routes
    Route::resource(
        'incentive_program', 
        'IncentiveProgramController', 
        $restExceptions
    );

    // Item Rental routes
    Route::resource(
        'item_rental', 
        'ItemRentalController', 
        $restExceptions
    );

    // User routes
    Route::resource(
        'user', 
        'UserController', 
        $restExceptions
    );
});
