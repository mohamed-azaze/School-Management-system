<?php

use App\Http\Controllers\SharedController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Shared Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

require __DIR__ . '/auth.php';

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ], function () {

        Route::group(['middleware' => 'auth:teacher,web'], function () {
            Route::get('/Get_classrooms/{id}', [SharedController::class, 'Get_classrooms']);
            Route::get('/Get_Sections/{id}', [SharedController::class, 'Get_Sections']);
        });

    });