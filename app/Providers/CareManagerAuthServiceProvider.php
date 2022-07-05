<?php

namespace App\Providers;

use App\Actions\Manager\AttemptToAuthenticate;
use App\Http\Controllers\Auth\CareManagerAuthController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;

class CareManagerAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app
            ->when([CareManagerAuthController::class, AttemptToAuthenticate::class])
            ->needs(StatefulGuard::class)
            ->give(function () {
                return Auth::guard('care-manager');
            });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
