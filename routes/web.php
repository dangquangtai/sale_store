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
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MailController;
use App\Http\Middleware\AccessPermisson;


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
Route::get('/send-mail/{orderId}', [MailController::class, 'send_mail']);
//index
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category_home']);
Route::get('/thuong-hieu-san-pham/{brand_id}', [BrandProduct::class, 'show_brand_home']);
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'detail_product']);
Route::post('/tim-kiem', [HomeController::class, 'search']);
Route::get('san-pham', [HomeController::class, 'product']);

//login admin
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::post('admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::group(['middleware' => 'admin.roles'], function () {
    // user
    Route::get('/manage-user', [UserController::class, 'manage_user']);
    Route::get('/edit-user/{id_user}', [UserController::class, 'edit_user']);
    Route::get('/delete-user/{id_user}', [UserController::class, 'delete_user']);
    Route::post('/update-user/{id_user}', [UserController::class, 'update_user']);
    Route::get('/lock-customer/{id_user}', [UserController::class, 'lock_user']);
    Route::get('/unlock-customer/{id_user}', [UserController::class, 'unlock_user']);
});





    

  
    Route::group(['middleware' => 'admin.roles'], function () {
        // Authentication roles
        Route::get('/phan-quyen', [UserController::class, 'index']);
        Route::post('/assign-roles', [UserController::class, 'assign_roles']);
        Route::get('/them-admin', [UserController::class, 'add_admin']);
        Route::post('/ save-add-admin', [UserController::class, 'save_add_admin']);
        Route::get('/xoa-admin/{adminId}', [UserController::class, 'delete_admin']);
       
    });





Route::group(['middleware' => 'auth.roles'], function () {


    // statistical
    Route::post('/filter-by-day', [AdminController::class, 'filter_by_day']);
    Route::post('/dasboard-filter', [AdminController::class, 'dasboard_filter']);
    Route::post('/load-filter', [AdminController::class, 'dasboard_filter_30day']);
    Route::post('/get-info-by-day', [AdminController::class, 'get_info_by_day']);
    Route::post('/get-info-dasboard-filter', [AdminController::class, 'get_info_dasboard_filter']);
    Route::post('/load-info-30day', [AdminController::class, 'load_info_30day']);

    //product
    Route::get('/add-product', [ProductController::class, 'add_product']);
    Route::get('/all-product', [ProductController::class, 'all_product']);
    Route::post('/save-product', [ProductController::class, 'save_product']);
    Route::get('/search-admin-product', [ProductController::class, 'search_admin_product']);
    Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);
    Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
    Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
    Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);
    Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);

    //brand
    Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
    Route::get('/all-brand-product', [brandProduct::class, 'all_brand_product']);
    Route::post('/save-brand-product', [brandProduct::class, 'save_brand_product']);
    Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class, 'unactive_brand_product']);
    Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product']);
    Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product']);
    Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product']);
    Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product']);
    Route::get('search-brand', [BrandProduct::class, 'search_brand']);

    //category
    Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
    Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);
    Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);
    Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
    Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);
    Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
    Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);
    Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);
    Route::get('search-catename', [CategoryProduct::class, 'search_catename']);

    // gallery product
    Route::get('/view-product-image', [ProductController::class, 'view_product_image']);
    Route::get('/list-image/{product_id}', [ProductController::class, 'list_image']);
    Route::get('/add-product-image', [ProductController::class, 'add_product_image']);
    Route::get('/edit-image/{id_product}', [ProductController::class, 'edit_image']);
    Route::get('/delete-image/{id_product}', [ProductController::class, 'delete_image']);
    Route::post('/update-image/{id_product}', [ProductController::class, 'update_image']);
    Route::post('/save-add-product-image', [ProductController::class, 'save_add_product_image']);

    //  post manager
    Route::get('/add-cate-post', function () {
        return view('admin.add_cate_post');
    });
    Route::post('/save-add-cate-post', [PostController::class, 'save_add_cate_post']);
    Route::get('/view-cate-post', [PostController::class, 'view_cate_post']);
    Route::get('/edit-cate-post/{catepostId}', [PostController::class, 'edit_cate_post']);
    Route::post('/update-cate-post/{catepostId}', [PostController::class, 'update_cate_post']);
    Route::get('/delete-cate-post/{catepostId}', [PostController::class, 'delete_cate_post']);
    Route::get('/unactive-cate-post/{catepostId}', [PostController::class, 'unactive_cate_post']);
    Route::get('/active-cate-post/{catepostId}', [PostController::class, 'active_cate_post']);

    Route::get('/add-post', [PostController::class, 'add_post']);
    Route::post('/save-add-post', [PostController::class, 'save_add_post']);
    Route::get('/view-post', [PostController::class, 'view_post']);
    Route::get('/edit-post/{postId}', [PostController::class, 'edit_post']);
    Route::post('/update-post/{postId}', [PostController::class, 'update_post']);
    Route::get('/delete-post/{postId}', [PostController::class, 'delete_post']);
    Route::get('/unactive-post/{postId}', [PostController::class, 'unactive_post']);
    Route::get('/active-post/{postId}', [PostController::class, 'active_post']);

    // tin tuc
    Route::get('/tin-tuc', [PostController::class, 'view_news']);
    Route::get('/post-detail/{postId}', [PostController::class, 'post_detail']);
    Route::get('/post-cate-detail/{postcateId}', [PostController::class, 'post_cate_detail']);


    // edit-website-image
    Route::get('/edit-website-image', [PostController::class, 'edit_slider']);
    Route::post('/update-slider', [PostController::class, 'update_slider']);

    //manage order
    Route::get('/manage-order', [CheckoutController::class, 'manage_order']);
    Route::get('/view-order/{orderId}', [CheckoutController::class, 'detail_order']);
    Route::get('/edit-order/{orderId}', [CheckoutController::class, 'edit_order']);
    Route::get('/delete-order/{orderId}', [CheckoutController::class, 'delete_order']);
    Route::post('/update-order/{orderId}', [CheckoutController::class, 'update_order']);
    Route::get('/confirm-order/{orderId}', [CheckoutController::class, 'confirm_order']);
    Route::get('/cancel-order/{orderId}', [CheckoutController::class, 'cancel_order']);


    Route::get('/view-mail', function () {
        return view('admin.send_mail');
    });
    Route::get('/mail-order/{orderId}', [CheckoutController::class, 'mail_order']);
    Route::get('/test-mail', [CheckoutController::class, 'test_mail']);
});

Route::get('/search-product', [ProductController::class, 'search_product']);
Route::post('/display-cate', [ProductController::class, 'display_cate']);





Route::post('/update-page', [HomeController::class, 'update_page']);
Route::get('/search-price', [HomeController::class, 'search_price']);






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
//Login facebook
Route::get('/login-facebook', [AdminController::class, 'login_facebook']);
Route::get('/admin/callback', [AdminController::class, 'callback_facebook']);

Route::get('/login-google', [AdminController::class, 'login_google']);
Route::get('/google/callback', [AdminController::class, 'callback_google']);












// Comment
Route::get('/manage-comment', [CommentController::class, 'manage_comment']);
Route::post('/admin-reply-coment', [CommentController::class, 'admin_reply_coment']);
Route::get('/delete-coment/{idComent}', [CommentController::class, 'delete_comment']);
Route::get('/delete-reply-coment/{idrlpComent}', [CommentController::class, 'delete_reply_comment']);
Route::post('/save-rating', [CommentController::class, 'save_rating']);
Route::post('/load-rating', [CommentController::class, 'load_rating']);



Route::post('/post-coment', [CommentController::class, 'send_coment']);
Route::post('/load-coment', [CommentController::class, 'load_coment']);
Route::post('/reply-comment', [CommentController::class, 'reply_comment']);







Route::get('/get-shipping', [CheckoutController::class, 'get_shipping']);
// Route::get('/to-shipping-detail', function () {
//     return view('pages.cart.shipping_detail');
// });
Route::get('/info-shipping', [CheckoutController::class, 'info_shipping']);
Route::post('/save-shipping', [CheckoutController::class, 'save_shipping']);
Route::post('/display-history', [CheckoutController::class, 'display_history']);
Route::post('/display-other', [CheckoutController::class, 'display_other']);

Route::get('/personal-info', [CheckoutController::class, 'person_info']);
Route::post('/update-profile', [CheckoutController::class, 'update_profile']);
Route::post('/update-password', [CheckoutController::class, 'update_password']);


// trang vặt

Route::get('/trang-chi-tiet', function () {
    return view('pages.different.about');
});
Route::get('/lien-he', function () {
    return view('pages.different.contact');
});
// Route::get('/personal-info', function () {
//     return view('pages.checkout.personal_info');
// });
