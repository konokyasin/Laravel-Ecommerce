<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'IndexController@index');

//product details page route
Route::get('/products/{id}', 'ProductsController@products');
//index categories route
Route::get('/categories/{category_id}', 'IndexController@categories');
//different product price route
Route::get('/get-product-price', 'ProductsController@getPrice');
//login register route
Route::get('/login-register', 'UsersController@userLoginRegister');
//add user route
Route::post('/user-register', 'UsersController@register');
//logout user route
Route::get('/user-logout', 'UsersController@logout');
//user login
Route::post('/user-login', 'UsersController@login');
//add to cart route
Route::post('/store-cart', 'ProductsController@storeCart');
//view cart
Route::get('/cart', 'ProductsController@cart')->middleware('verified');
//delete cart product
Route::get('/cart/delete-product/{id}', 'ProductsController@deleteCartProduct');
//route for update quantity in cart
Route::get('/cart/update-quantity/{id}/{quantity}', 'ProductsController@updateCartQuantity');
//apply coupon route
Route::post('/cart/apply-coupon', 'ProductsController@applyCoupon');

Route::get('/admin', 'AdminController@login');

Route::post('/admin-store', 'AdminController@loginStore')->name('admin.store');

Auth::routes(['verify'=>true]);

Route::get('/home', 'IndexController@home');

Route::group(['middleware' => ['frontlogin']], function () {
    //user account
    Route::get('/account', 'UsersController@account');
    //change password
    Route::get('/change-password', 'UsersController@changePassword');
    Route::post('/store-password', 'UsersController@storePassword');
    //change address
    Route::get('/change-address', 'UsersController@changeAddress');
    Route::post('/store-address', 'UsersController@storeAddress');
    //checkout page
    Route::get('/checkout', 'ProductsController@checkout');
    Route::post('/checkout-store', 'ProductsController@storeCheckout');
    //order review
    Route::get('/order-review', 'ProductsController@orderReview');
    //place order
    Route::post('/place-order', 'ProductsController@placeOrder');
    //thanks message
    Route::get('/thanks-message', 'ProductsController@thanks');
    //stripe payment
    Route::get('/stripe', 'ProductsController@stripe');
    Route::post('/stripe-payment', 'ProductsController@stripePayment');
    //user orders list
    Route::get('/orders', 'ProductsController@userOrders');
    Route::get('/orders/{id}', 'ProductsController@userOrderDetails');
});
    

Route::group(['middleware' => ['auth']], function () {
    //dashboard route
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    //category route
    Route::get('/admin/add-category', 'CategoryController@addCategory')->name('admin.add-category');
    Route::post('/admin/store-category', 'CategoryController@storeCategory')->name('admin.store-category');
    Route::get('/admin/view-categories', 'CategoryController@viewCategories')->name('admin.view-categories');
    Route::get('/admin/edit-category/{id}', 'CategoryController@editCategory')->name('admin.edit-category');
    Route::post('/admin/update-category/{id}', 'CategoryController@updateCategory')->name('admin.update-category');
    Route::any('/admin/delete-category/{id}', 'CategoryController@deleteCategory')->name('admin.delete-category');
    Route::post('/admin/update-category-status', 'CategoryController@categoryStatus')->name('admin.category-status');
    //product route
    Route::get('/admin/add-product', 'ProductsController@addProduct')->name('admin.add-product');
    Route::post('/admin/store-product', 'ProductsController@storeProduct')->name('admin.store-product');
    Route::get('/admin/view-products', 'ProductsController@viewProducts')->name('admin.view-products');
    Route::get('/admin/edit-product/{id}', 'ProductsController@editProduct')->name('admin.edit-product');
    Route::post('/admin/update-product/{id}', 'ProductsController@updateProduct')->name('admin.update-product');
    Route::any('/admin/delete-product/{id}', 'ProductsController@deleteProduct')->name('admin.delete-product');
    Route::post('/admin/update-product-status', 'ProductsController@updateStatus')->name('admin.update-status');
    Route::post('/admin/update-featured-product-status', 'ProductsController@updateFeatured')->name('admin.featured-status');
    //product attributes route
    Route::get('/admin/add-attributes/{id}', 'ProductsController@addAttribute')->name('admin.add-attributes');
    Route::post('/admin/store-attributes/{id}', 'ProductsController@storeAttribute')->name('admin.store-attributes');
    Route::post('/admin/update-attributes/{id}', 'ProductsController@updateAttribute')->name('admin.update-attributes');
    Route::any('/admin/delete-attributes/{id}', 'ProductsController@deleteAttribute')->name('admin.delete-attributes');
    Route::get('/admin/add-images/{id}', 'ProductsController@addImages')->name('admin.add-images');
    Route::post('/admin/store-images/{id}', 'ProductsController@storeImages')->name('admin.store-images');
    Route::get('/admin/delete-alt-image/{id}', 'ProductsController@deleteAltImage')->name('admin.delete-alt-image');
    //banner route
    Route::get('/admin/banners', 'BannersController@banners')->name('admin.banners');
    Route::get('/admin/add-banners', 'BannersController@addBanner')->name('admin.add-banner');
    Route::post('/admin/store-banners', 'BannersController@storeBanner')->name('admin.store-banner');
    Route::get('/admin/edit-banners/{id}', 'BannersController@editBanner')->name('admin.edit-banner');
    Route::post('/admin/update-banners/{id}', 'BannersController@updateBanner')->name('admin.update-banner');
    Route::any('/admin/delete-banners/{id}', 'BannersController@deleteBanner')->name('admin.delete-banner');
    Route::post('/admin/update-banner-status', 'BannersController@bannerStatus')->name('admin.banner-status');
    //coupon route
    Route::get('/admin/add-coupon', 'CouponsController@addCoupon')->name('admin.add-coupon');
    Route::post('/admin/store-coupons', 'CouponsController@storeCoupon')->name('admin.store-coupons');
    Route::get('/admin/view-coupons', 'CouponsController@viewCoupons')->name('admin.view-coupons');
    Route::get('/admin/edit-coupon/{id}', 'CouponsController@editCoupon')->name('admin.edit-coupon');
    Route::post('/admin/update-coupon/{id}', 'CouponsController@updateCoupon')->name('admin.update-coupon');
    Route::any('/admin/delete-coupon/{id}', 'CouponsController@deleteCoupon')->name('admin.delete-coupon');
    Route::post('/admin/update-coupon-status', 'CouponsController@couponStatus')->name('admin.coupon-status');
    //order route
    Route::get('/admin/orders', 'ProductsController@viewOrders')->name('admin.orders');
    Route::get('/admin/orders/{id}', 'ProductsController@viewOrderDetails')->name('admin.order-details');
    //update order status
    Route::post('/admin/update-order-status', 'ProductsController@updateOrderStatus')->name('update-order-status');

});

Route::get('/logout', 'AdminController@logout')->name('admin.logout');
