<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Auth\Events\CareManagerRegistered;
use App\Auth\Events\CareReceiverRegistered;
use App\Auth\Events\NursingCareOfficeRegistered;
use App\Auth\Listeners\SendCareManagerEmailVerificationNotification;
use App\Auth\Listeners\SendCareReceiverEmailVerificationNotification;
use App\Auth\Listeners\SendNursingCareOfficeEmailVerificationNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CareManagerRegistered::class => [
            SendCareManagerEmailVerificationNotification::class,
        ],
        CareReceiverRegistered::class => [
            SendCareReceiverEmailVerificationNotification::class,
        ],
        NursingCareOfficeRegistered::class => [
            SendNursingCareOfficeEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
