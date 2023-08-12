<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\OrderController;

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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/user_login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => ['jwt.verify']], function ()
{
    Route::get('/list_product', [ApiController::class , 'list_product'])->name('list_product');
    Route::post('/place_order', [OrderController::class , 'place_order'])->name('place_order');
    Route::get('/get_order_details', [OrderController::class , 'get_order_details'])->name('get_order_details');

});