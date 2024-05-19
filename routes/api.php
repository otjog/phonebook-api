<?php

use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//
Route::middleware(['auth:sanctum'])
    ->controller(ContactController::class)
    ->group(function () {
        Route::get('/contacts', 'index');
        Route::post('/contacts', 'store');
        Route::get('/contacts/{id}', 'show');
        Route::put('/contacts/{id}', 'update');
        Route::delete('/contacts/{id}', 'destroy');
});

Route::middleware(['auth:sanctum', 'throttle:6,1'])->group(function () {
    Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed'])->name('front.verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->name('front.verification.send');
});
