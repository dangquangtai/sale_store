<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);
//send mail
Route::get('/send-mail', [HomeController::class, 'send_mail']);
//index
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category_home']);
Route::get('/thuong-hieu-san-pham/{brand_id}', [BrandProduct::class, 'show_brand_home']);
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'detail_product']);
Route::post('/tim-kiem', [HomeController::class, 'search']);
Route::get('/san-pham', [HomeController::class, 'product']);

//login admin
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::post('admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);

// user
Route::get('/manage-user', [UserController::class, 'manage_user']);
Route::get('/edit-user/{id_user}', [UserController::class, 'edit_user']);
Route::get('/delete-user/{id_user}', [UserController::class, 'delete_user']);
Route::post('/update-user/{id_user}', [UserController::class, 'update_user']);


//category
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);
Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);
Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);

//brand
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::get('/all-brand-product', [brandProduct::class, 'all_brand_product']);
Route::post('/save-brand-product', [brandProduct::class, 'save_brand_product']);
Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product']);
Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product']);

//product
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/all-product', [ProductController::class, 'all_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);
Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::post('/update-page', [HomeController::class, 'update_page']);
Route::post('/search-price', [HomeController::class, 'search_price']);



//cart
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::get('/cart-destroy', [CartController::class, 'cart_destroy']);
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart']);
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
Route::post('/delete-cart-product', [CartController::class, 'delete_cart_product']);


//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/register-checkout', [CheckoutController::class, 'register_checkout']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);

Route::post('/order-place', [CheckoutController::class, 'order_place']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);
Route::get('/payment', [CheckoutController::class, 'payment']);

//manage order
Route::get('/manage-order', [CheckoutController::class, 'manage_order']);
Route::get('/view-order/{orderId}', [CheckoutController::class, 'view_order']);
Route::get('/view-mail', function () {
    return view('admin.send_mail');
});
Route::get('/mail-order/{orderId}', [CheckoutController::class, 'mail_order']);
Route::get('/test-mail', [CheckoutController::class, 'test_mail']);

// Comment
Route::post('/post-coment', [ProductController::class, 'send_coment']);
Route::post('/load-coment', [ProductController::class, 'load_coment']);
Route::post('/reply-comment', [ProductController::class, 'reply_comment']);

Route::get('/search-product', [ProductController::class, 'search_product']);



Route::get('/get-shipping', [CheckoutController::class, 'get_shipping']);
// Route::get('/to-shipping-detail', function () {
//     return view('pages.cart.shipping_detail');
// });
Route::post('/info-shipping', [CheckoutController::class, 'info_shipping']);
Route::post('/display-history', [CheckoutController::class, 'display_history']);

// trang vặt

Route::get('/trang-chi-tiet', function () {
    return view('pages.different.about');
});
Route::get('/lien-he', function () {
    return view('pages.different.contact');
});


//git
