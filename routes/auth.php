<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\CustomerPasswordResetController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\VerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');

    Route::post('register', [RegisterController::class, 'store'])->name('customer.register');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [CustomerPasswordResetController::class, 'create'])->name('password.request');

    Route::get('verify-customer/{customer_id}/prompt', [VerificationController::class, 'verifyPrompt'])
        ->name('verification.notice');

    Route::post('verify-customer/{customer_id}', [VerificationController::class, 'verify'])
        ->name('verification.verify');

    Route::post('resend-code/{customer_id}', [VerificationController::class, 'resendCode'])
        ->name('verification.resend');

    Route::post('/forgot-password/send-code', [CustomerPasswordResetController::class, 'sendCode'])
        ->name('send.code');

    Route::get('/forgot-password/verify-code', [CustomerPasswordResetController::class, 'showVerifyForm'])
        ->name('verify.code.form');

    Route::post('/forgot-password/verify-code', [CustomerPasswordResetController::class, 'verifyCode'])
        ->name('verify.code');

    Route::post('/forgot-password/reset', [CustomerPasswordResetController::class, 'resetPassword'])->name('reset.password');


});

Route::middleware('auth:customer')->group(function () {


    Route::get('/password/change', function () {
        return view('auth.change-password');
    })->name('password.change');

    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
