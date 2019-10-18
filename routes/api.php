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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');
Route::get('get_categories', 'API\UserController@getCategories');
Route::get('get_products', 'API\ProductController@getProducts');
Route::get('recent_products', 'API\ProductController@getLatestProducts');
Route::get('header_categories', 'API\ProductController@getHeaderCategories');
Route::get('explore_categories', 'API\ProductController@getExploreCategories');
Route::post('user_location', 'API\UserController@saveLocations');
Route::post('user_location', 'API\UserController@saveLocations');
Route::get('search_categories/{id}', 'API\CategoryController@search');
Route::get('farm/{id}', 'API\UserController@farmDetail');
Route::get('product_detail/{id}', 'API\UserController@farmDetail');
Route::post('search', 'API\CategoryController@searchMultiple');
Route::get('track_order/{id}', 'API\OrderController@trackOrder');

Route::group(['middleware' => ['auth:api', 'checkSession']], function () {
    Route::post('save_card', 'API\UserController@saveCard');
    Route::get('logout', 'API\UserController@logout');
    Route::post('save_order', 'API\OrderController@saveOrder');
});
