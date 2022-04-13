<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:api')->group(function () {
    Route::post('/makeRequisition', [ApiController::class, 'makeRequisition']);
    Route::post('/viewAllRequisition', [ApiController::class, 'viewAllRequisition']);
    Route::post('/requisitionDetails', [ApiController::class, 'requisitionDetails']);
    Route::post('/passwordReset', [ApiController::class, 'passwordReset']);
});

Route::post('/login', [ApiController::class, 'login']);
Route::get('/siteSetting', [ApiController::class, 'siteSetting']);
Route::get('/banner', [ApiController::class, 'bannerList']);
Route::get('/allDistrict', [ApiController::class, 'allDistrict']);
Route::get('/allUpazilla', [ApiController::class, 'allUpazilla']);
Route::get('/allUnion', [ApiController::class, 'allUnion']);
Route::post('/adminRegister', [ApiController::class, 'adminRegister']);

Route::post('/allProductWithCategory', [ApiController::class, 'allProductWithCategory']);
Route::get('/categoryWiseProduct', [ApiController::class, 'categoryWiseProduct']);
Route::post('/productDetails', [ApiController::class, 'productDetails']);
Route::get('/hotProduct', [ApiController::class, 'hotProduct']);

