<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);
Route::middleware('jwt.auth')->group(function () {
    Route::prefix('contact')->group(function () {
        Route::get('list', [\App\Http\Controllers\ContactController::class, 'list']);
        Route::post('create', [\App\Http\Controllers\ContactController::class, 'create']);
        Route::post('update', [\App\Http\Controllers\ContactController::class, 'update']);
        Route::delete('delete/{id}', [\App\Http\Controllers\ContactController::class, 'delete']);
    });
    Route::prefix('contact-detail')->group(function () {
        Route::get('{contactId}/list', [\App\Http\Controllers\ContactInfoController::class, 'list']);
        Route::post('{contactId}/create', [\App\Http\Controllers\ContactInfoController::class, 'create']);
        Route::post('{contactId}/update', [\App\Http\Controllers\ContactInfoController::class, 'update']);
        Route::delete('delete/{id}', [\App\Http\Controllers\ContactInfoController::class, 'delete']);
    });
    Route::prefix('report')->group(function () {
        Route::get('{location}/sameLocation', [\App\Http\Controllers\ReportController::class, 'baseLocation']);
        Route::get('{location}/phone', [\App\Http\Controllers\ReportController::class, 'sameLocationWithPhone']);
    });
});
