<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use  App\Http\Controllers\UserPannelController;
use Illuminate\Support\Facades\Auth;

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

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [UserPannelController::class, 'userDashboard'])->name('dashboard');

    Route::get('/userProfile', [UserPannelController::class, 'userProfile'])->name('user.profile');
    Route::get('/userProfileEdit', [UserPannelController::class, 'userProfileEdit'])->name('user.profile.edit');
    Route::post('/userProfileUpdate/{id}', [UserPannelController::class, 'userProfileUpdate'])->name('user.profile.update');
    Route::get('/userPassword', function(){ return view('user.profile.password'); })->name('user.password.change');
    Route::post('/userPasswordUpdate/{id}', [UserPannelController::class, 'userPasswordUpdate'])->name('user.password.update');
    
});






require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
