<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\Api\UsersController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/about', function(Request $request){
    return [
        'name'=>"order-system",
        "created_at"=>'2021-07-16'
    ];
});


Route::post('/register', [UsersController::class, 'registerUser'])->name('register-user');
Route::post('/login', [UsersController::class, 'userLogin'])->name('user-login');

//core routes
Route::get('/category', [UsersController::class, 'getCategory'])->name('category');




