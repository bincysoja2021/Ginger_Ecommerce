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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/forbidden', [App\Http\Controllers\UserController::class, 'forbidden'])
        ->name('forbidden');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('permission:dashboard')->name('home');

//user
Route::get('/list_user', [App\Http\Controllers\UserController::class, 'index'])->middleware('permission:list_user')->name('list_user');
Route::get('/add_user',[App\Http\Controllers\UserController::class, 'add_user'])->middleware('permission:add_user')->name('add_user');
Route::post('/user_store', [App\Http\Controllers\UserController::class, 'store'])->name('user_store');
Route::get('/user_edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->middleware('permission:edit_user')->name('user_edit');
Route::get('/user_update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user_update');
Route::delete('/user_destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user_destroy');

//Role

Route::get('/list_role', [App\Http\Controllers\RoleController::class, 'index'])->middleware('permission:list_role')->name('list_role');
Route::get('/add_role', [App\Http\Controllers\RoleController::class, 'add_role'])->name('add_role');
Route::post('/role_store', [App\Http\Controllers\RoleController::class, 'store'])->name('role_store');
Route::get('/role_edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role_edit');
Route::get('/role_update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('role_update');
Route::delete('/role_destroy/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('role_destroy');


//category
Route::get('/list_category', [App\Http\Controllers\CategoryController::class, 'index'])->middleware('permission:list_category')->name('list_category');
Route::get('/add_category', [App\Http\Controllers\CategoryController::class, 'add_category'])->middleware('permission:add_category')->name('add_category');
Route::post('/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('store');
Route::get('/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->middleware('permission:edit_category')->name('edit');
Route::get('/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('update');
Route::delete('/destroy/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->middleware('permission:delete_category')->name('destroy');


//product

Route::get('/list_product', [App\Http\Controllers\ProductController::class, 'index'])->middleware('permission:list_product')->name('list_product');
Route::get('/add_product', [App\Http\Controllers\ProductController::class, 'add_product'])->middleware('permission:add_product')->name('add_product');
Route::post('/product_store', [App\Http\Controllers\ProductController::class, 'store'])->name('product_store');
Route::get('/product_edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->middleware('permission:edit_product')->name('product_edit');
Route::get('/product_update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product_update');
Route::delete('/product_destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product_destroy');