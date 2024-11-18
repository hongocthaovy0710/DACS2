<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProductController;

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index');
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
Route::post('/save-category-product', [CategoryProductController::class, 'save_category_product']);