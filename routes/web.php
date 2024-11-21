<?php

use App\Http\Controllers\BrandProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/trang chu', 'App\Http\Controllers\HomeController@index');
Route::get('/shop','App\Http\Controllers\HomeController@show_category');
Route::get('/shop-detail','App\Http\Controllers\HomeController@show_shop_detail');
Route::get('/contact','App\Http\Controllers\HomeController@contact');


Route::get('/tintuc', function () {
    return view('news');
});
Route::get('/trang-tin', 'App\Http\Controllers\NewsController@index');
Route::get('/gioi-thieu', 'App\Http\Controllers\NewsController@index2');

// phan code cho admin
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/admin-dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');

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
