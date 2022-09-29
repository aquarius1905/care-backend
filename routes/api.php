<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\Auth\CareManagerAuthController;
use App\Http\Controllers\Auth\CareReceiverAuthController;
use App\Http\Controllers\Auth\NursingCareOfficeAuthController;
use App\Http\Controllers\HomeCareSupportOfficeController;
use App\Http\Controllers\CareLevelController;
use App\Http\Controllers\CareManagerController;
use App\Http\Controllers\CareReceiverController;
use App\Http\Controllers\WeeklyServiceScheduleController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\VerifyCareManagerEmailController;
use App\Http\Controllers\VerifyCareReceiverEmailController;
use App\Http\Controllers\VerifyNursingCareOfficeEmailController;
use App\Http\Controllers\NursingCareOfficeController;
use App\Http\Controllers\VisitDatetimeController;

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

Route::apiResource(
    '/care-levels',
    CareLevelController::class
)->only(['index']);

Route::apiResource(
    '/home-care-support-offices',
    HomeCareSupportOfficeController::class
)->only(['index', 'store']);

Route::apiResource(
    '/service-types',
    ServiceTypeController::class
)->only(['index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dayofweeks-and-servicetypes', [
        WeeklyServiceScheduleController::class, 'getDayofweeksAndServiceTypes'
    ]);
});

if (Features::enabled(Features::emailVerification())) {
    $verificationLimiter = config('fortify.limiters.verification', '6,1');

    Route::get(
        '/care-managers/email/verify/{id}/{hash}',
        [VerifyCareManagerEmailController::class, '__invoke']
    )
        ->middleware(['signed', 'throttle:' . $verificationLimiter])
        ->name('care-manager.verification.verify');

    Route::get(
        '/care-receivers/email/verify/{id}/{hash}',
        [VerifyCareReceiverEmailController::class, '__invoke']
    )
        ->middleware(['signed', 'throttle:' . $verificationLimiter])
        ->name('care-receiver.verification.verify');

    Route::get(
        '/nursing-care-offices/email/verify/{id}/{hash}',
        [VerifyNursingCareOfficeEmailController::class, '__invoke']
    )
        ->middleware(['signed', 'throttle:' . $verificationLimiter])
        ->name('nursing-care-office.verification.verify');
}


Route::prefix('/care-managers')->group(function () {

    Route::post('/', [CareManagerController::class, 'store']);

    Route::middleware('caremanager.verified')->group(function () {
        Route::post('/login', [CareManagerAuthController::class, 'store']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [CareManagerAuthController::class, 'me']);
        Route::post('/logout', [CareManagerAuthController::class, 'destroy']);
        Route::apiResource('/visit', VisitDatetimeController::class)->only([
            'store', 'update'
        ]);
        Route::put('/{id}', [CareManagerController::class, 'update']);
    });
});

Route::prefix('care-receivers')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [CareReceiverController::class, 'index']);
        Route::post('/', [CareReceiverController::class, 'store']);
        Route::post('/logout', [CareReceiverAuthController::class, 'destroy']);
    });

    Route::middleware('carereceiver.verified')->group(function () {
        Route::post('/login', [CareReceiverAuthController::class, 'store']);
    });
});

Route::apiResource('/care-receivers', CareReceiverController::class)->only([
    'store', 'update',
]);
Route::post('/care-receivers/batch-delete', [
    CareReceiverController::class, 'batchDelete'
]);

Route::prefix('nursing-care-offices')->group(function () {
    Route::post('/', [NursingCareOfficeController::class, 'store']);

    Route::middleware('nursingcareoffice.verified')->group(function () {
        Route::post('/login', [NursingCareOfficeAuthController::class, 'store']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [NursingCareOfficeAuthController::class, 'destroy']);
    });
});
