<?php

namespace  App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])
        ->middleware('auth:admin');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('auth:admin')
        ->name('dashboard');

    Route::get('/register', [Auth\RegisteredUserController::class, 'create'])
        ->middleware('guest:admin')
        ->name('register');

    Route::post('/register', [Auth\RegisteredUserController::class, 'store'])
        ->middleware('guest:admin');

    Route::get('/login', [Auth\AuthenticatedSessionController::class, 'create'])
        ->middleware('guest:admin')
        ->name('login');

    Route::post('/login', [Auth\AuthenticatedSessionController::class, 'store'])
        ->middleware('guest:admin');

    Route::get('/forgot-password', [Auth\PasswordResetLinkController::class, 'create'])
        ->middleware('guest:admin')
        ->name('password.request');

    Route::post('/forgot-password', [Auth\PasswordResetLinkController::class, 'store'])
        ->middleware('guest:admin')
        ->name('password.email');

    Route::get('/reset-password/{token}', [Auth\NewPasswordController::class, 'create'])
        ->middleware('guest:admin')
        ->name('password.reset');

    Route::post('/reset-password', [Auth\NewPasswordController::class, 'store'])
        ->middleware('guest:admin')
        ->name('password.update');

    Route::get('/verify-email', [Auth\EmailVerificationPromptController::class, '__invoke'])
        ->middleware('auth:admin')
        ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [Auth\VerifyEmailController::class, '__invoke'])
        ->middleware(['auth:admin', 'signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [Auth\EmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth:admin', 'throttle:6,1'])
        ->name('verification.send');

    Route::get('/confirm-password', [Auth\ConfirmablePasswordController::class, 'show'])
        ->middleware('auth:admin')
        ->name('password.confirm');

    Route::post('/confirm-password', [Auth\ConfirmablePasswordController::class, 'store'])
        ->middleware('auth:admin');

    Route::post('/logout', [Auth\AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:admin')
        ->name('logout');
});


Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    Route::resource('admin', AdminController::class);
    Route::resource('user', UserController::class);
    Route::resource('language', LanguageController::class);
    Route::resource('languageKey', LanguageKeyController::class);
    Route::resource('siteSetting', SiteSettingController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('dcAdmin', DcAdminController::class);
    Route::resource('unoAdmin', UnoAdminController::class);
    Route::resource('unionAdmin', UnionAdminController::class);
    Route::resource('chairmanAdmin', ChairmanAdminController::class);
    Route::resource('udcAdmin', UdcAdminController::class);

    Route::get('languageSelect', [LanguageSelectController::class, 'languageSelect'])->name('language.select');
    Route::post('languageSelect', [LanguageSelectController::class, 'languageSelection'])->name('language.select');
    Route::get('adminApprove/{id}', [CommonController::class, 'adminApprove'])->name('admin.approve');
    Route::get('adminReject/{id}', [CommonController::class, 'adminReject'])->name('admin.reject');

});
