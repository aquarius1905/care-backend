<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Fortify\Features;
use App\Http\Controllers\Auth\CareManagerAuthController;
use App\Http\Controllers\Auth\CareManagerResetPasswordController;
use App\Http\Controllers\Auth\CareReceiverAuthController;
use App\Http\Controllers\Auth\NursingCareOfficeAuthController;
use App\Http\Controllers\Auth\VerifyCareManagerEmailController;
use App\Http\Controllers\Auth\VerifyCareReceiverEmailController;
use App\Http\Controllers\Auth\VerifyNursingCareOfficeEmailController;
use App\Http\Controllers\CancellationController;
use App\Http\Controllers\CareLevelController;
use App\Http\Controllers\CareManagerController;
use App\Http\Controllers\CareReceiverController;
use App\Http\Controllers\DaycareDiaryController;
use App\Http\Controllers\WeeklyServiceScheduleController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\NursingCareOfficeController;
use App\Http\Controllers\VisitDatetimeController;
use App\Http\Controllers\RehabilitationContentController;

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
    '/service-types',
    ServiceTypeController::class
)->only(['index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource(
        '/care-levels',
        CareLevelController::class
    )->only(['index']);

    Route::apiResource(
        '/rehabilitation-contents',
        RehabilitationContentController::class
    )->only(['index']);

    Route::get('/service-types/nursing-care-offices', [
        ServiceTypeController::class, 'getServiceTypesWithNursingCareOffices'
    ]);
    Route::get('/weekly-service-schedules', [
        WeeklyServiceScheduleController::class, 'showByCareReceiverId'
    ]);
    Route::get('/weekly-service-schedules/search', [
        WeeklyServiceScheduleController::class, 'searchByNursingCareOfficeId'
    ]);
    Route::get('/daycare-diaries/search', [
        DaycareDiaryController::class, 'search'
    ]);

    Route::apiResource(
        '/daycare-diaries',
        DaycareDiaryController::class
    )->only(['store']);

    Route::apiResource(
        '/weekly-service-schedules',
        WeeklyServiceScheduleController::class
    )->only(['store', 'destroy']);

    Route::put(
        '/daycare-diaries/situation-at-home-updates',
        [
            DaycareDiaryController::class,
            'updateSituationAtHome'
        ]
    );
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

if (Features::enabled(Features::resetPasswords())) {

    Route::get(
        '/care-managers/reset-password/{token}',
        [CareManagerResetPasswordController::class, '__invoke']
    )->name('care-manager.password.reset');

    Route::get('/care-receivers/reset-password/{token}', function (Request $request) {
        return redirect(config('app.front') . '/care-receiver/reset-password');
    })->name('care-receiver.password.reset');

    Route::get('/nursing-care-offices/reset-password/{token}', function (Request $request) {
        return redirect(config('app.front') . '/nursing-care-office/reset-password');
    })->name('nursing-care-office.password.reset');

    Route::post(
        '/care-managers/forgot-password',
        [CareManagerAuthController::class, 'forgotPassword']
    );
    Route::post(
        '/care-receivers/forgot-password',
        [CareReceiversAuthController::class, 'forgotPassword']
    );
    Route::post(
        '/nursing-care-offices/forgot-password',
        [NursingCareOfficeAuthController::class, 'forgotPassword']
    );
}


Route::prefix('/care-managers')->group(function () {

    Route::post('/', [CareManagerController::class, 'store']);

    Route::middleware('caremanager.verified')->group(function () {
        Route::post('/login', [CareManagerAuthController::class, 'store']);
    });



    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [CareManagerAuthController::class, 'me']);
        Route::post('/logout', [CareManagerAuthController::class, 'destroy']);
        Route::apiResource('/visit-datetime', VisitDatetimeController::class)->only([
            'store', 'update'
        ]);
        Route::put('/{id}', [CareManagerController::class, 'update']);
    });
});

Route::prefix('care-receivers')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [CareReceiverController::class, 'index']);
        Route::get('/me', [CareReceiverAuthController::class, 'me']);
        Route::post('/', [CareReceiverController::class, 'store']);
        Route::post('/cancel', [CancellationController::class, 'store']);
        Route::post('/logout', [CareReceiverAuthController::class, 'destroy']);
        Route::put('/{id}', [CareReceiverController::class, 'update']);
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
        Route::get('/me', [NursingCareOfficeAuthController::class, 'me']);
        Route::post('/logout', [NursingCareOfficeAuthController::class, 'destroy']);
        Route::put('/{id}', [NursingCareOfficeController::class, 'update']);
    });
});
