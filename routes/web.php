<?php

use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/trang chu', 'App\Http\Controllers\HomeController@index');
Route::get('/shop','App\Http\Controllers\HomeController@show_category');
Route::get('/shop-detail','App\Http\Controllers\HomeController@show_shop_detail');
Route::get('/contact','App\Http\Controllers\HomeController@contact');
Route::post('/tim-kiem','App\Http\Controllers\HomeController@search');

//gửi mail
Route::get('/send-mail','App\Http\Controllers\HomeController@send_mail');


Route::get('/trang-tin', 'App\Http\Controllers\NewsController@index');
Route::get('/gioi-thieu', 'App\Http\Controllers\NewsController@index2');

// phan code cho admin
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('dashboard');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard')->name('dashboard');

Route::group(['middleware' => ['web']], function () {
    Route::get('/login-facebook', [AdminController::class, 'login_facebook']);
    Route::get('/admin/callback', [AdminController::class, 'callback_facebook']);
});

// Định nghĩa route cho CategoryProductController
Route::get('/add-category-product', [CategoryProductController::class, 'add_category_product']);
Route::get('/all-category-product', [CategoryProductController::class, 'all_category_product']);
Route::get('/unactive-category-product/{category_product_id}', [CategoryProductController::class, 'unactive_category_product'])->name('unactive-category-product');
Route::get('/active-category-product/{category_product_id}', [CategoryProductController::class, 'active_category_product'])->name('active-category-product');
Route::post('/save-category-product', [CategoryProductController::class, 'save_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProductController::class, 'edit_category_product'])->name('edit-category-product');
Route::get('/delete-category-product/{category_product_id}', [CategoryProductController::class, 'delete_category_product'])->name('delete-category-product');
Route::post('/update-category-product/{category_product_id}', [CategoryProductController::class, 'update_category_product'])->name('update-category-product');

// Định nghĩa route cho BrandProductController
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']);
Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class, 'unactive_brand_product'])->name('unactive-brand-product');
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product'])->name('active-brand-product');
Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product'])->name('edit-brand-product');
Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product'])->name('delete-brand-product');
Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product'])->name('update-brand-product');

// Định nghĩa route cho ProductController
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/all-product', [ProductController::class, 'all_product']);
Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product'])->name('unactive-product');
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product'])->name('active-product');
Route::post('/save-product', [ProductController::class, 'save_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product'])->name('edit-product');
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product'])->name('delete-product');
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product'])->name('update-product');

//Danh muc san pham index
Route::get('/danh-muc-san-pham/{category_id}',[CategoryProductController::class,'show_category_home']);
Route::get('/thuong-hieu-san-pham/{brand_id}',[BrandProduct::class,'show_brand_home']);
Route::get('/chi-tiet-san-pham/{product_id}',[ProductController::class,'details_product']);
Route::get('/', [ProductController::class, 'showNewProducts']);


//cart
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/gio-hang', [CartController::class, 'gio_hang']);
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{rowID}', [CartController::class, 'delete_to_cart']);
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::get('/del-product/{session_id}', [CartController::class, 'delete_product']);
Route::get('/del-all-product',[CartController::class,'delete_all_product']);


//coupon
Route::post('/check-coupon',[CartController::class,'check_coupon']);

//Checkout
Route::post('/calculate-fee', [CheckoutController::class, 'calculate_fee'])->name('calculate-fee');
Route::post('/select-delivery-home', [CheckoutController::class, 'select_delivery_home'])->name('select-delivery-home');
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::post('login-customer',[CheckoutController::class,'login_customer']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::post('/save-checkout-customer',[CheckoutController::class,'save_checkout_customer']);
Route::post('/order-place', [CheckoutController::class, 'order_place'])->name('order-place');



//đơn hàng
Route::get('/manager-order', [OrderController::class, 'manage_order'])->name('manager-order');
Route::get('/view-order/{order_code}', [OrderController::class, 'view_order'])->name('view-order');




// Delivery
Route::get('/delivery', [DeliveryController::class, 'delivery'])->name('delivery');
Route::post('/insert-delivery', [DeliveryController::class, 'insert_delivery'])->name('insert-delivery');
Route::post('/select-delivery', [DeliveryController::class, 'select_delivery'])->name('select-delivery');
Route::post('/select-feeship', [DeliveryController::class, 'select_feeship'])->name('select-feeship');
Route::post('/update-delivery', [DeliveryController::class, 'update_delivery'])->name('update-delivery');