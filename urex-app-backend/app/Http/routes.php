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
    Route::group(['prefix' => 'announcement'], function() use ($restExceptions) {
        Route::resource(
            '/',
            'AnnouncementController',
            $restExceptions
        );
        Route::get('category/{category_id}', 'AnnouncementController@index_category');
    });

    // Category routes
    Route::resource(
        'category',
        'CategoryController',
        $restExceptions
    );

    // Event routes
    Route::group(['prefix' => 'event'], function() use ($restExceptions) {
        Route::resource(
            '/',
            'EventController',
            $restExceptions
        );
        Route::get('category/{category_id}', 'EventController@index_category');
        Route::get('{id}/image', 'EventController@show_images');
        Route::put('{id}/image/{image_id}', 'EventController@add_image');
        Route::delete('{id}/image/{image_id}', 'EventController@delete_image');
    });

    // Feedback routes
    Route::resource(
        'feedback',
        'FeedbackController',
        $restExceptions + ['update']
    );

    // Hour routes
    Route::group(['prefix' => 'hour'], function() use ($restExceptions) {
        Route::resource(
            '/',
            'HourController',
            $restExceptions
        );
        Route::get('category/{category_id}', 'HourController@index_category');
    });

    // Hours Exception routes
    Route::group(['prefix' => 'hours_exception'], function() use ($restExceptions) {
        Route::resource(
            '/',
            'HoursExceptionController',
            $restExceptions
        );
        Route::get('category/{category_id}', 'HoursExceptionController@index_category');
    });

    // Image routes
    Route::group(['prefix' => 'image'], function() use ($restExceptions) {
        Route::resource(
            '/',
            'ImageController',
            $restExceptions + ['update']
        );
        Route::get('category/{category_id}', 'ImageController@index_category');
    });

    // Incentive Program routes
    Route::group(['prefix' => 'incentive_program'], function() use ($restExceptions) {
        Route::resource(
            '/',
            'IncentiveProgramController',
            $restExceptions
        );
        Route::get('{id}/image', 'IncentiveProgramController@show_images');
        Route::put('{id}/image/{image_id}', 'IncentiveProgramController@add_image');
        Route::delete('{id}/image/{image_id}', 'IncentiveProgramController@delete_image');
    });

    // Item Rental routes
    Route::resource(
        'item_rental', 
        'ItemRentalController', 
        $restExceptions
    );

    // User routes
    Route::group(['prefix' => 'user'], function() use ($restExceptions) {
        Route::resource(
            '/', 
            'UserController', 
            $restExceptions
        );
        Route::get('category/{category_id}', 'UserController@index_category');
    });
});
