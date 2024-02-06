<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\ParentController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\StudentController;
use App\Http\Controllers\Auth\TeacherController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    //#################### auth Admin #######################

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login/admin', [AuthenticatedSessionController::class, 'store'])
        ->name('login.admin');

    //#################### auth student #######################

    Route::post('login/student', [StudentController::class, 'store'])
        ->name('login.student');

    //#################### auth teacher #######################

    Route::post('login/teacher', [TeacherController::class, 'store'])
        ->name('login.teacher');

    //#################### auth parent #######################

    Route::post('login/parent', [ParentController::class, 'store'])
        ->name('login.parent');

    //#################### auth #######################

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

//################ logout Auth ####################

Route::post('logout', [TeacherController::class, 'destroy'])
    ->middleware('auth:teacher')
    ->name('logout.teacher');

Route::post('logout/parent', [ParentController::class, 'destroy'])
    ->middleware('auth:parent')
    ->name('logout.parent');

Route::post('logout/student', [StudentController::class, 'destroy'])
    ->middleware('auth:student')
    ->name('logout.student');

Route::post('logout/admin', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:web')
    ->name('logout.admin');

//##################################################

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

});