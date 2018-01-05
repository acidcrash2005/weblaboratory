<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // Your overwrites here
    Route::get('lesson/filter', ['uses' => 'Voyager\VoyagerController@filter', 'as' => 'filter']);
    Route::get('user/filter', ['uses' => 'Voyager\VoyagerController@filter', 'as' => 'filter']);
    Route::get('user-purchas/filter', ['uses' => 'Voyager\VoyagerController@filter', 'as' => 'filter']);
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('page', function(){
  $pages = App\Pages::all();

  foreach ($pages as $page) {
    echo ('<h2>'.$page->title.'</h2>');
  }
});

Route::get('posts', 'PostsController@index');
Route::get('posts/{slug}', 'PostsController@view');

Route::get('vebinars', 'VebinarsController@index');
Route::get('vebinars/{slug}', 'VebinarsController@view');



Route::get('/img/{path}', 'ImageController@show')->where('path', '.*');


// Auth Access
Route::group(['middleware' => ['auth']], function () {
    // User Page for trening
    Route::get('user_page','UserpageController@index');
    Route::get('courses','UserpageController@courses');
    Route::get('courses/{slug}','UserpageController@curse');
    Route::get('courses/{slug}/{id}','UserpageController@cursePage');

    Route::post('payform','PayesController@payform');

    Route::get('user_product','UserpageController@products');
});

// Base Access
Route::group(['middleware' => ['base']], function () {
    // DZ
    Route::post('dz_post', 'HomeworkController@add');
    Route::post('dz_post_answer', 'HomeworkController@addAnaswer');
});


// Premium Access
Route::group(['middleware' => ['premium']], function () {

});


// Vip Access
Route::group(['middleware' => ['vip']], function () {

});

// Moderator Access
Route::group(['middleware' => ['moderator']], function () {
    Route::get('moderation', 'ModerationController@index');
    Route::get('moderation/dialog/{id}', 'ModerationController@dialog');
    Route::post('moderation/dialog/{id}', 'ModerationController@status');
    Route::get('moderation/user_dialogs/{id}', 'ModerationController@user_dialogs');


});



// Profile
Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@update');

// Courses
//Route::get('curses','CourseController@index');
//Route::get('curse/{slug}','CourseController@view');

Route::get('readmessage/{id}/{dialog}','HomeworkController@readmessage');
Route::get('readanswer/{id}/{dialog}','HomeworkController@readanswer');

// Sistem
Route::get('userpay','UserController@userpay');

// Bay
Route::post('bay','PayesController@bay');
Route::post('order','PayesController@order');
Route::get('order_get/{id}','PayesController@order_get');

// Pay API
Route::get('pay', 'PayesController@index');
Route::post('pay', 'PayesController@api');
Route::post('wayforpay', 'PayesController@wayforpay');

Route::get('redirect', 'PayesController@redirect');

Route::get('pay_test', 'PayesController@test');


// User Order
Route::get('orders', 'OrdersController@index');
Route::get('user_products','ProductsController@user_products');
Route::get('user_products/view/{id}','ProductsController@user_product_view');

// Shop link
Route::get('products', 'ProductsController@index');
Route::get('course/{id}', 'ProductsController@course');
Route::get('product/{id}', 'ProductsController@product');



Route::post('product_bay','PayesController@product_bay');


Route::get('test', 'PayesController@test');


