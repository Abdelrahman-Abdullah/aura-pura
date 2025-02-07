<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\{
    UserRegisterController,
    UserSessionController,
    VerifyEmailController,
    GoogleLoginController,
    ProfileController,
    ProgressController
};

#region Users
Route::prefix('users')
    ->as('users.')
    ->group(function () {
        Route::post('/register', UserRegisterController::class)->name('register');
        Route::post('/verify-email', [VerifyEmailController::class,'verifyEmail'])->name('verify-email');
        Route::post('/login', [UserSessionController::class,'login'])->name('login');

        Route::post('/login/google',[GoogleLoginController::class,'redirectToGoogle'])->name('login.google');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [UserSessionController::class,'logout'])->name('logout');

            Route::controller(ProfileController::class)
            ->group(function () {
                Route::get('/profile','show')->name('profile.show');
                Route::put('/profile/update','update')->name('profile.update');

            });

            Route::post('test', [ProgressController::class, 'store'])->name('test.store');
        });

    });

#endregion

