<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\CareManagerAuthController;
use App\Http\Controllers\Auth\ProviderAuthController;
use App\Http\Controllers\HomeCareSupportOfficeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CareManagerController;
use App\Http\Controllers\CareReceiverController;
use App\Http\Controllers\KeyPersonController;
use App\Http\Controllers\CareLevelController;
use App\Http\Controllers\VerifyCareManagerEmailController;
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
Route::apiResource('/care-levels', CareLevelController::class)->only([
    'index'
]);

Route::prefix('care-managers')->group(function () {
    // ケアマネージャーメール認証
    $verificationLimiter = config('fortify.limiters.verification', '6,1');
    Route::get('/email/verify/{id}/{hash}', [VerifyCareManagerEmailController::class,  '__invoke'])
        ->middleware(['auth:care-manager', 'signed', 'throttle:' . $verificationLimiter])->name('care-manager.verification.verify');
});

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

Route::prefix('care-managers')->group(function () {
    Route::post('/login', [CareManagerAuthController::class, 'store']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [CareManagerAuthController::class, 'me']);
        Route::post('/logout', [CareManagerAuthController::class, 'destroy']);
    });
});

Route::prefix('key-persons')->group(function () {
    Route::post('/login', [KeyPersonAuthController::class, 'store']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [KeyPersonAuthController::class, 'destroy']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/care-receivers', CareReceiverController::class)->only([
        'index', 'store', 'show'
    ]);
    Route::apiResource('/key-persons', KeyPersonController::class)->only([
        'store'
    ]);
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
