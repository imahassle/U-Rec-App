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

Route::get('/', function() {
    return View::make('application');
});

Route::get('/mobile', function() {
    echo "nasknakjnfjanad";
    return View::make('mobile');
});

// RESTful API Routes
Route::group(['prefix' => 'api'], function() {
    // Auth routes
    Route::post('login', 'Api\AuthController@login');

    // Announcement routes
    Route::group(['prefix' => 'announcement'], function() {
        Route::get('/', 'Api\AnnouncementController@index');
        Route::post('/' , 'Api\AnnouncementController@store');
        Route::get('/{id}', 'Api\AnnouncementController@show');
        Route::put('/{id}', 'Api\AnnouncementController@update');
        Route::delete('/{id}', 'Api\AnnouncementController@destroy');
        Route::get('category/{category_id}', 'Api\AnnouncementController@index_category');
    });

    // Category routes
    Route::group(['prefix' => 'category'], function() {
        Route::get('/', 'Api\CategoryController@index');
        Route::post('/' , 'Api\CategoryController@store');
        Route::get('/{id}', 'Api\CategoryController@show');
        Route::put('/{id}', 'Api\CategoryController@update');
        Route::delete('/{id}', 'Api\CategoryController@destroy');
    });

    // Event routes
    Route::group(['prefix' => 'event'], function() {
        Route::get('/', 'Api\EventController@index');
        Route::post('/' , 'Api\EventController@store');
        Route::get('/{id}', 'Api\EventController@show');
        Route::put('/{id}', 'Api\EventController@update');
        Route::delete('/{id}', 'Api\EventController@destroy');
        Route::get('category/{category_id}', 'Api\EventController@index_category');
        Route::get('{id}/image', 'Api\EventController@show_images');
        Route::post('{id}/image/{image_id}', 'Api\EventController@associate_image');
        Route::delete('{id}/image/{image_id}', 'Api\EventController@dissociate_image');
    });

    // Feedback routes
    Route::group(['prefix' => 'feedback'], function() {
        Route::get('/', 'Api\FeedbackController@index');
        Route::post('/' , 'Api\FeedbackController@store');
        Route::get('/{id}', 'Api\FeedbackController@show');
        Route::delete('/{id}', 'Api\FeedbackController@destroy');
    });

    // Hour routes
    Route::group(['prefix' => 'hour'], function() {
        Route::get('/', 'Api\HourController@index');
        Route::post('/' , 'Api\HourController@store');
        Route::get('/{id}', 'Api\HourController@show');
        Route::put('/{id}', 'Api\HourController@update');
        Route::delete('/{id}', 'Api\HourController@destroy');
        Route::get('category/{category_id}', 'Api\HourController@index_category');
    });

    // Hours Exception routes
    Route::group(['prefix' => 'hours_exception'], function() {
        Route::get('/', 'Api\HoursExceptionController@index');
        Route::post('/' , 'Api\HoursExceptionController@store');
        Route::get('/{id}', 'Api\HoursExceptionController@show');
        Route::put('/{id}', 'Api\HoursExceptionController@update');
        Route::delete('/{id}', 'Api\HoursExceptionController@destroy');
        Route::get('category/{category_id}', 'Api\HoursExceptionController@index_category');
    });

    // Image routes
    Route::group(['prefix' => 'image'], function() {
        Route::get('/', 'Api\ImageController@index');
        Route::post('/' , 'Api\ImageController@store');
        Route::get('/{id}', 'Api\ImageController@show');
        Route::delete('/{id}', 'Api\ImageController@destroy');
        Route::get('category/{category_id}', 'Api\ImageController@index_category');
    });

    // Incentive Program routes
    Route::group(['prefix' => 'incentive_program'], function() {
        Route::get('/', 'Api\IncentiveProgramController@index');
        Route::post('/' , 'Api\IncentiveProgramController@store');
        Route::get('/{id}', 'Api\IncentiveProgramController@show');
        Route::put('/{id}', 'Api\IncentiveProgramController@update');
        Route::delete('/{id}', 'Api\IncentiveProgramController@destroy');
        Route::get('{id}/image', 'Api\IncentiveProgramController@show_images');
        Route::post('{id}/image/{image_id}', 'Api\IncentiveProgramController@associate_image');
        Route::delete('{id}/image/{image_id}', 'Api\IncentiveProgramController@dissociate_image');
    });

    // Item Rental routes
    Route::group(['prefix' => 'item_rental'], function() {
        Route::get('/', 'Api\ItemRentalController@index');
        Route::post('/' , 'Api\ItemRentalController@store');
        Route::get('/{id}', 'Api\ItemRentalController@show');
        Route::put('/{id}', 'Api\ItemRentalController@update');
        Route::delete('/{id}', 'Api\ItemRentalController@destroy');
    });

    // User routes
    Route::group(['prefix' => 'user'], function() {
        Route::get('/', 'Api\UserController@index');
        Route::post('/' , 'Api\UserController@store');
        Route::get('/{id}', 'Api\UserController@show');
        Route::put('/{id}', 'Api\UserController@update');
        Route::delete('/{id}', 'Api\UserController@destroy');
        Route::get('category/{category_id}', 'Api\UserController@index_category');
        Route::put('/{id}/password', 'Api\UserController@update_password');
    });
});
