<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LienheController;
use App\Http\Controllers\Cart;
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


//Frontend
Route::get('/','App\Http\Controllers\HomeController@index');
Route::get('/trang-chu','App\Http\Controllers\HomeController@index');
Route::get('/san-pham','App\Http\Controllers\HomeController@product');
Route::get('san-pham/fetch_data','App\Http\Controllers\HomeController@fetch_data');
Route::get('/tim-kiem','App\Http\Controllers\HomeController@search');
Route::get('/show-sanpham','App\Http\Controllers\HomeController@show_sanpham');
Route::get('/lien-he','App\Http\Controllers\LienheController@index');

//Trang Chủ

//Danh mục sản phẩm
Route::get('/danh-muc-san-pham/{category_id}','App\Http\Controllers\CategoryProduct@show_category_home');

//Thương Hiệu sản phẩm
Route::get('/thuong-hieu-san-pham/{brand_id}','App\Http\Controllers\BrandProduct@show_brand_home');

//Chi Tiết Sản Phẩm
Route::get('/chi-tiet-san-pham/{product_id}','App\Http\Controllers\ProductController@details_product');






//Backend
// Route::get('/admin','App\Http\Controllers\AdminController@index');

Route::group(['middleware' => 'auth.admin'], function () {
Route::group(['middleware' => 'auth.stat.roles','auth.stat.roles'=>['stat'] ], function () {
Route::get('/statistic','App\Http\Controllers\StatController@show_statistic');
Route::post('/statistic-date','App\Http\Controllers\StatController@show_statistic_date');
});
});

Route::get('/logout','App\Http\Controllers\AdminController@logout');
// Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');

//Phân Quyền

Route::get('/register-auth','App\Http\Controllers\AuthController@register_auth');
Route::post('/register','App\Http\Controllers\AuthController@register');

Route::get('/admin','App\Http\Controllers\AuthController@login_auth');
Route::get('/login-auth','App\Http\Controllers\AuthController@login_auth');
Route::post('/login','App\Http\Controllers\AuthController@login');

Route::get('/logout-auth','App\Http\Controllers\AuthController@logout_auth');


Route::group(['middleware' => 'auth.admin'], function () {
Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');
Route::group(['middleware' => 'auth.admin.roles','auth.admin.roles'=>['admin'] ], function () {
Route::get('/edit-auth/{admin_id}','App\Http\Controllers\AuthController@edit_auth');
Route::post('/update-users/{admin_id}','App\Http\Controllers\AuthController@update_users');
Route::get('/add-user','App\Http\Controllers\UserController@add_user');
Route::post('/store-users','App\Http\Controllers\UserController@store_users');
Route::get('/all-user','App\Http\Controllers\UserController@all_user');
Route::get('/delete-user-roles/{admin_id}','App\Http\Controllers\UserController@delete_user_roles');
Route::post('/assign-roles','App\Http\Controllers\UserController@assign_roles');
});
});

//Category Product
//Danh mục sản phẩm
Route::group(['middleware' => 'auth.admin'], function () {
Route::group(['middleware' => 'auth.category.roles','auth.category.roles'=>['category'] ], function () {
Route::get('/add-category-product','App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@delete_category_product');
Route::get('/all-category-product','App\Http\Controllers\CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@unactive_category_product');
//Gửi id danh mục sản phẩm vào function
Route::get('/active-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@active_category_product');

//hàm post của các nút
Route::post('/save-category-product','App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','App\Http\Controllers\CategoryProduct@update_category_product');
});
});

//Brand product
//Thương hiệu của sản phẩm
Route::group(['middleware' => 'auth.admin'], function () {
Route::group(['middleware' => 'auth.brand.roles','auth.brand.roles'=>['brand'] ], function () {
Route::get('/add-brand-product','App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@delete_brand_product');
Route::get('/all-brand-product','App\Http\Controllers\BrandProduct@all_brand_product');


Route::get('/unactive-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@unactive_brand_product');
//Gửi id danh mục sản phẩm vào function
Route::get('/active-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@active_brand_product');

//hàm post của các nút
Route::post('/save-brand-product','App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','App\Http\Controllers\BrandProduct@update_brand_product');
});
});


//product
//Thương hiệu của sản phẩm
Route::group(['middleware' => 'auth.admin'], function () {
Route::group(['middleware' => 'auth.product.roles','auth.product.roles'=>['product'] ], function () {
Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');
Route::get('/all-product','App\Http\Controllers\ProductController@all_product');


Route::get('/unactive-product/{product_id}','App\Http\Controllers\ProductController@unactive_product');
//Gửi id danh mục sản phẩm vào function
Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product');

//hàm post của các nút
Route::post('/save-product','App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}','App\Http\Controllers\ProductController@update_product');
});
});

//Quản lý đơn hàng
//Order
Route::group(['middleware' => 'auth.admin'], function () {
Route::group(['middleware' => 'auth.order.roles','auth.order.roles'=>['order'] ], function () {
Route::get('/manage-order','App\Http\Controllers\CheckoutController@manage_order');
Route::get('/view-order/{orderId}','App\Http\Controllers\CheckoutController@view_order');

//Thay đổi trạng thái đơn hàng
Route::get('/unactive-order/{order_id}','App\Http\Controllers\CheckoutController@unactive_order');
Route::get('/active-order/{order_id}','App\Http\Controllers\CheckoutController@active_order');

//Hủy đơn hàng
Route::get('/delete-order/{order_id}','App\Http\Controllers\CheckoutController@delete_order');

//Khôi phục đơn hàng
Route::get('/return-order/{order_id}','App\Http\Controllers\CheckoutController@return_order');
});
});


//Slider Banner
Route::group(['middleware' => 'auth.admin'], function () {
Route::group(['middleware' => 'auth.slider.roles','auth.slider.roles'=>['slider'] ], function () {
Route::get('/manage-slider','App\Http\Controllers\SliderController@manage_slider');

Route::get('/add-slider','App\Http\Controllers\SliderController@add_slider');
Route::post('/save-slider','App\Http\Controllers\SliderController@save_slider');
Route::get('/delete-slider/{slider_id}','App\Http\Controllers\SliderController@delete_slider');
Route::get('/edit-slider/{slider_id}','App\Http\Controllers\SliderController@edit_slider');
Route::post('/update-slider/{slider_id}','App\Http\Controllers\SliderController@update_slider');

Route::get('/unactive-slider/{slider_id}','App\Http\Controllers\SliderController@unactive_slider');

Route::get('/active-slider/{slider_id}','App\Http\Controllers\SliderController@active_slider');
});
});

//Gallery
Route::group(['middleware' => 'auth.admin'], function () {
Route::group(['middleware' => 'auth.product.roles','auth.product.roles'=>['product'] ], function () {
Route::get('/add-gallery/{product_id}','App\Http\Controllers\GalleryController@add_gallery');
Route::post('select-gallery','App\Http\Controllers\GalleryController@select_gallery');
Route::post('insert-gallery/{pro_id}','App\Http\Controllers\GalleryController@insert_gallery');
Route::post('delete-gallery','App\Http\Controllers\GalleryController@delete_gallery');
});
});




//frontend
Route::get('/account','App\Http\Controllers\AccountController@show_account');
Route::get('/view-order-customer/{orderId}','App\Http\Controllers\AccountController@view_order_customer');
Route::get('/delete-order-customer/{order_id}','App\Http\Controllers\AccountController@delete_order_customer');

//Cart
//Giỏ hàng
Route::post('/save-cart','App\Http\Controllers\CartController@save_cart');
Route::post('/update-cart-quantity','App\Http\Controllers\CartController@update_cart_quantity');
Route::get('/show_cart','App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','App\Http\Controllers\CartController@delete_to_cart');
//rowId là id của nguyên row trong giỏ hàngs

//Cart ajax
Route::post('/add-cart-ajax','App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/show-cart-ajax','App\Http\Controllers\CartController@show_cart_ajax');
Route::post('/update-cart-ajax','App\Http\Controllers\CartController@update_cart_ajax');
Route::get('/delete-product-ajax/{session_id}','App\Http\Controllers\CartController@delete_product_ajax');
Route::get('/delete-all-product-ajax','App\Http\Controllers\CartController@delete_all_product_ajax');

//checkout
//Thanh Toán

//Kiểm Tra đăng nhập
Route::get('/login-checkout','App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout','App\Http\Controllers\CheckoutController@logout_checkout');

//Đăng Kí
Route::post('/add-customer','App\Http\Controllers\CheckoutController@add_customer');

//Đăng Nhập
Route::post('/login-customer','App\Http\Controllers\CheckoutController@login_customer');
Route::post('/login-customer-ajax','App\Http\Controllers\CheckoutController@login_customer_ajax'); //đăng nhập bằng Ajax


//Thanh Toán Đã Đăng Nhập
Route::get('/checkout','App\Http\Controllers\CheckoutController@checkout');

Route::get('/payment','App\Http\Controllers\CheckoutController@payment');

//Lưu thông tin thanh toán của khách hàng
Route::post('/save-checkout-customer','App\Http\Controllers\CheckoutController@save_checkout_customer');

//Đặt hàng
Route::post('/order-place','App\Http\Controllers\CheckoutController@order_place');

Route::get('/handcash','App\Http\Controllers\CheckoutController@handcash');

