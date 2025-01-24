<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\SocialiteController;

Route::prefix('v1/auth')->group(function () {
    // Sanctum & Normal Auth
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
    Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']);

    // Socialite - Google
    Route::get('google/redirect', [SocialiteController::class, 'redirectToGoogle']);
    Route::get('google/callback', [SocialiteController::class, 'handleGoogleCallback']);

    // Email Verification
    Route::get('email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('email/resend', [VerifyEmailController::class, 'resendVerificationEmail'])
        ->middleware(['auth:sanctum'])
        ->name('verification.send');

    // Authenticated Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', function (Request $request) {
            return $request->user();
        });

        Route::post('logout', [LogoutController::class, 'logout']);
    });
});
