<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\FrontController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    // return view('welcome');
    return redirect('dashboard');
});

Route::get('/home', [ FrontController::class, 'home' ]);
Route::get('/about', [ FrontController::class, 'about' ]);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [ DashboardController::class, 'dashboard' ])->name('dashboard');
    Route::get('/logout', [ UsersController::class, 'logout' ])->name('logout');
    
    // Category
    Route::get('/category', [ CategoryController::class, 'category' ])->name('category');
    Route::post('/new-category', [ CategoryController::class, 'new_category' ])->name('new-category');
    // product
    Route::get('/product', [ ProductController::class, 'product' ])->name('product');
    Route::match(['get', 'post'],'/new-product', [ ProductController::class, 'add_product' ])->name('new-product');
    Route::match(['get', 'post'],'/edit-product/{product_id}', [ ProductController::class, 'edit_product' ])->name('edit-product');
    Route::match(['get'],'/delete-product-image/{product_id}/{image_id}', [ ProductController::class, 'deleteProductImage' ])->name('delete-product-image');
    Route::match(['get'],'/delete-product/{product_id}', [ ProductController::class, 'deleteProduct' ])->name('delete-product');

    

}); 

// guest section
Route::match(['get', 'post'],'/login', [ UsersController::class, 'login' ])->name('login');
Route::match(['get', 'post'],'/signup', [ UsersController::class, 'signup' ])->name('signup');
//change password
Route::match(['get', 'post'],'/change-password', [ UsersController::class, 'changePassword' ])->name('change-password');
Route::match(['get', 'post'],'/password-change', [ UsersController::class, 'PasswordChange' ])->name('password-change');
    
    





