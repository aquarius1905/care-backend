<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\ManagerAuthController;
use App\Http\Controllers\Auth\ProviderAuthController;
use App\Http\Controllers\HomeCareSupportOfficeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CareManagerController;
use App\Http\Controllers\ProviderController;
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

Route::apiResource('/home-care-support-offices', HomeCareSupportOfficeController::class)->only([
    'index'
]);

Route::apiResource('/care-managers', CareManagerController::class)->only([
    'store'
]);

// ユーザー
Route::prefix('users')->group(function () {
    // 登録
    Route::post('/', [UserController::class, 'store'])->name('users.register');
    // ログイン
    Route::post('/login', [UserAuthController::class, 'store'])->name('users.login');
    Route::middleware('auth:web')->group(function () {
        // ログアウト
        Route::post('/logout', [UserAuthController::class, 'destroy'])->name('users.logout');
    });
});

// ケアマネジャー
Route::prefix('care-managers')->group(function () {
    // ログイン
    Route::post('/login', [ManagerAuthController::class, 'store'])->name('managers.login');
    Route::middleware('auth:manager')->group(function () {
        // ログアウト
        Route::post('/logout', [ManagerAuthController::class, 'destroy'])->name('managers.logout');
    });
});

// 介護事業者
Route::prefix('providers')->group(function () {
    // 登録
    Route::post('/', [ProviderController::class, 'store'])->name('providers.register');
    // ログイン
    Route::post('/login', [ProviderAuthController::class, 'store'])->name('providers.login');
    Route::middleware('auth:provider')->group(function () {
        // ログアウト
        Route::post('/logout', [ProviderAuthController::class, 'destroy'])->name('providers.logout');
    });
});
