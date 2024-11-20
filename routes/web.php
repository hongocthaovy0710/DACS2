<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProductController;

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/trang chu', 'App\Http\Controllers\HomeController@index');
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
Route::get('/edit-category-product', [CategoryProductController::class, 'edit_category_product']);
Route::get('/delete-category-product', [CategoryProductController::class, 'delete_category_product']); 
Route::get('/all-category-product', [CategoryProductController::class, 'all_category_product']);
Route::get('/unactive-category-product/{category_product_id}', [CategoryProductController::class, 'unactive_category_product'])->name('unactive-category-product');
Route::get('/active-category-product/{category_product_id}', [CategoryProductController::class, 'active_category_product'])->name('active-category-product');
Route::post('/save-category-product', [CategoryProductController::class, 'save_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProductController::class, 'edit_category_product'])->name('edit-category-product');
Route::get('/delete-category-product/{category_product_id}', [CategoryProductController::class, 'delete_category_product'])->name('delete-category-product');
Route::post('/update-category-product/{category_product_id}', [CategoryProductController::class, 'update_category_product'])->name('update-category-product');