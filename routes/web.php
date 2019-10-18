<?php

Route::get('/cart', 'ProductController@index');
//default Auth Routes
//Auth::routes();
Route::get('test', 'admin\UserController@test');
//Auth\VerificationController handle Email Verificaiton
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::group(['prefix' => '/', 'middleware' => ['share_data_to_views']], function () {
    Route::post('/sendforget', 'AuthController@sendForgotPassword');
    Route::get('/reset_password/{token?}', 'AuthController@resetPasswordView');
    Route::post('/reset_password', 'AuthController@postResetPassword');
    //    Route::post('/user/login','AuthController@userLogin')->name('user.login_');
    Route::get('/', 'Frontend\HomeController@index')->name('user.home');
    Route::post('/user/login', 'AuthController@userLoginAjax')->name('user.login_');
    Route::post('/user/register', 'AuthController@userRegistrationAjax')->name('user.register');
    //    Route::post('/user/register','AuthController@userRegistration')->name('user.register');
    //categories
    Route::get('category/{slug}', 'Frontend\HomeController@showCategoryProducts')->name('category.show');
    //load more products ajax base
    Route::get('load_more_products', 'Product\ProductController@loadMoreProducts')->name('ajax.load_more_products');
    Route::get('add_to_cart', 'Cart\CartController@addToCart')->name('product.add_to_cart');
    Route::get('product/{slug}', 'Product\ProductController@productDetail')->name('product.detail');

    //cart
    Route::get('cart', 'Cart\CartController@getProductFromCart')->name('cart.get_products');
    Route::get('cart_decrease', 'Cart\CartController@descreaseCartItem')->name('cart.decrease_cart');
    Route::get('cart_increase', 'Cart\CartController@increaseCartItem')->name('cart.increase_cart');
    Route::get('remove_item_from_cart', 'Cart\CartController@removeItemFromCart')->name('cart.remove_item_from_cart');

    // search
    Route::get('tag/{tag}', 'Product\ProductSearchController@getProductsByTag')->name('product.show_products_by_tag');

    //shop
    Route::get('shop', 'Product\ProductSearchController@getPoductsForShop')->name('product.show_shop_data');
    Route::get('search', 'Product\ProductSearchController@searchProductsByZipCode')->name('product.search_by_zip_code');

    // get search result
    Route::post('get_search_results', 'Product\ProductSearchController@getSearchResults')->name('ajax.get_search_result');
    //get search result for search by category
    Route::post('search_by_category', 'Product\ProductSearchController@searchByCategory')->name('ajax.search_by_category');
    Route::post('get_farmers_products', 'Product\ProductSearchController@getFarmersProducts')->name('ajax.get_farmers_products');
    Route::get('get_latest_products', 'Product\ProductSearchController@getLatestProducts')->name('ajax.get_latest_products');
    Route::post('get_per_page_prodcuts_for_search_by_zip', 'Product\ProductSearchController@getPerPageProductsForSearchByZip')->name('ajax.get_per_page_prodcuts_for_search_by_zip');
    Route::post('get_per_page_products_of_category', 'Product\ProductSearchController@getPerPageProductsOfCategory')->name('ajax.get_per_page_prodcuts_by_category');
    Route::post('get_per_page_prodcuts_for_shop', 'Product\ProductSearchController@getPerPageProductsForShop')->name('ajax.get_per_page_prodcuts_for_shop');

    //tag base search
    Route::post('get_per_page_prodcuts_for_tag', 'Product\ProductSearchController@getPerPageProductsForTag')->name('ajax.get_per_page_prodcuts_for_tag');
    Route::get('get_latest_products_for_tag_page', 'Product\ProductSearchController@getLatestProductsForTagPage')->name('ajax.get_latest_products_for_tag_page');
    Route::post('get_search_results_for_tag_page', 'Product\ProductSearchController@getSearchResultsForTagPage')->name('ajax.get_search_result_for_tag_page');

    //search product by name
    Route::get('search_by_name', 'Product\ProductSearchController@searchProductsByName')->name('search_product_by_name');
    Route::post('get_per_page_search_products_by_name', 'Product\ProductSearchController@getPerPageProductsByName')->name('ajax.get_per_page_search_products_by_name');
    Route::get('get_latest_products_for_search_by_name', 'Product\ProductSearchController@getLatestProductsForSearchByName')->name('ajax.get_latest_products_for_search_by_name');
    Route::post('get_results_for_search_by_name', 'Product\ProductSearchController@getResultsForSearchByName')->name('ajax.get_results_for_search_by_name');
    //farmer
    Route::get('farmer/{id}', 'Farmer\FarmerController@openFarmerProfile')->name('show_farmer_profile');
    Route::post('get_per_page_prodcuts_for_farmer_page', 'Product\ProductSearchController@getPerPageProductsForFarmerPage')->name('ajax.get_per_page_prodcuts_for_farmer_page');
});

Route::get('farmer/login', 'AuthController@showFarmerLoginForm')->name('farmer.login');
Route::post('farmer/login', 'AuthController@FarmerLogin')->name('farmer.login.post');
Route::get('farmer/register', 'AuthController@showFarmerRegistrationForm')->name('farmer.register');
Route::post('farmer/register', 'AuthController@farmerRegistration')->name('farmer.register');

Route::group(['prefix' => 'farmer', 'middleware' => ['check.farmer']], function () {
    Route::get('/', 'Farmer\FarmerController@dashboardView')->name('farmer.dashboard');
    Route::get('/farmer_orders', 'Farmer\FarmerController@orders')->name('farmer.orders');
    Route::get('/farmer_orders_detail/{id}', 'Farmer\FarmerController@orderDetail');
    Route::post('/farmer_order_status', 'Farmer\FarmerController@orderStatus');
    Route::post('/complete_order', 'Farmer\FarmerController@orderComplete');
    Route::post('/farmer_info_post', 'Farmer\FarmerController@farmerInfo');
    Route::get('/farmer_orders_delete/{id}', 'Farmer\FarmerController@orderdelete');

    //Products

    Route::get('/add_products', 'Farmer\ProductController@addProduct');
    Route::get('/edit_products/{id}', 'Farmer\ProductController@editProduct');
    Route::post('/post_products', 'Farmer\ProductController@postProduct');
    Route::post('/edit_post_products', 'Farmer\ProductController@editpostProduct');
    Route::get('/farmer_products', 'Farmer\ProductController@products')->name('farmer.products');
    Route::get('/farmer_info', 'Farmer\FarmerController@info')->name('farmer.info');
    Route::get('/calendar_orders/{days}', 'Farmer\ProductController@calendarOrder');
    Route::get('/calendar/{days}', 'Farmer\ProductController@calendar');
    Route::get('/products_delete/{id}', 'Farmer\ProductController@productDelete');
    Route::post('delete_image', 'Farmer\ProductController@deleteImage');
    Route::post('delete_tags', 'Farmer\ProductController@deleteTags');
});
//Contact
Route::post('contact', 'User\UserController@contact');
Route::get('logout', 'AuthController@farmerLogout')->name('farmer.logout');
Route::get('user_logout', 'AuthController@userLogout')->name('user_logout');
Route::group(['prefix' => 'user', 'middleware' => ['checkUser']], function () {

    Route::get('/', 'User\UserController@orders');
    Route::get('/account', 'User\UserController@account');
    Route::post('/add_account', 'User\UserController@addAccount');
    Route::post('check_password', 'User\UserController@checkPassoword');
    Route::post('update_password', 'User\UserController@updatePassword');

    Route::get('/user_orders_detail/{id}', 'User\UserController@orderDetail');
    Route::get('/calendar/{days}', 'User\UserController@calendar');
});
//favorite and order for user

Route::group(['prefix' => '', 'middleware' => ['checkUser', 'share_data_to_views']], function () {
    //add form to fav
    Route::get('add_form_to_fav', 'Product\ProductController@addToFavourite')->name('form.add_form_to_fav');
    //add to favourite
    Route::get('add_to_favourite', 'Product\ProductController@addToFavourite')->name('product.add_to_favourite');
    Route::get('product/favorites/{id?}', 'Product\ProductController@showUserFavorites')->name('product.show_user_favorites');
    Route::get('remove_from_favorite', 'Product\ProductController@removeFromFavorite')->name('product.remove_form_favorite');
    //place order
    Route::get('place_on_hold_order', 'Product\ProductController@placeOnHoldOrder')->name('products.place_onhold_order');
    Route::post('place_visa_cart_order', 'Product\ProductController@placeVisaCartOrder')->name('product.place_visa_order');
});
Route::get('admin/login', 'admin\AuthController@loginView')->name('admin.login_form');
Route::post('login', 'admin\AuthController@login')->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => ['check.admin']], function () {
    Route::get('logout', 'admin\AuthController@logout')->name('admin.logout');
    Route::get('/', 'admin\AuthController@showDashboard')->name('admin.dashboard');
    //attribute controller
    Route::get('attributes', 'admin\AttributeController@index')->name('attributes');
    Route::post('add_attribute', 'admin\AttributeController@store')->name('attribute.store');
    Route::post('update_attribute', 'admin\AttributeController@update')->name('attribute.update');
    Route::get('delete_attribute/{id}', 'admin\AttributeController@destroy')->name('attribute.delete');

    //Categories

    Route::get('categories', 'admin\AdminController@allCategories')->name('categories');
    Route::post('add_category', 'admin\AdminController@addCategory')->name('add_category');
    Route::post('update_category', 'admin\AdminController@updateCategory')->name('update_category');
    Route::get('delete_category/{id}', 'admin\AdminController@deleteCategory')->name('admin/delete_category/{id}');

    //Products
    Route::get('products', 'admin\AdminController@allProducts')->name('products');
    Route::get('add_product/{id?}', 'admin\AdminController@addProduct')->name('add_product');
    Route::post('post_add_product', 'admin\AdminController@postAddProduct')->name('post_add_product');
    Route::post('update_add_product', 'admin\AdminController@updateAddProduct')->name('update_add_product');
    Route::post('delete_product_img', 'admin\AdminController@deleteProductImage')->name('delete_product_img');
    Route::get('delete_product/{id}', 'admin\AdminController@productDelete')->name('delete_product');
    Route::get('detail_product/{id}', 'admin\AdminController@detailProduct')->name('detail_product');

    //search products
    //tag controller
    Route::get('tag', 'admin\TagController@index')->name('tags');
    Route::post('add_tag', 'admin\TagController@store')->name('tag.store');
    Route::post('update_tag', 'admin\TagController@update')->name('tag.update');
    Route::get('delete_tag/{id}', 'admin\TagController@destroy')->name('tag.delete');

    // user
    Route::resource('user', 'admin\UserController');
    Route::resource('farmer', 'admin\FarmerController');
});

//route that will be executed when no other route matches the incoming request.
//Route::fallback(function () {
//    return  'route not found';
//});
//Fb Login
Route::get('facebook-login', 'SocialAuthController@redirect')->name('facebook.login');
Route::get('facebook', 'SocialAuthController@callback');
//google Login
Route::get('google-login', 'SocialAuthController@redirectToProvider')->name('google.login');
Route::get('google', 'SocialAuthController@handleProviderCallback');
