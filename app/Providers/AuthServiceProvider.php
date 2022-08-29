<?php

namespace App\Providers;

use App\Auth\Notifications\VerifyCareManagerEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        VerifyCareManagerEmail::createUrlUsing(function ($notifiable) {

            $params = [
                "expires" => Carbon::now()
                    ->addMinutes(60)
                    ->getTimestamp(),
                "id" => $notifiable->getKey(),
                "hash" => sha1($notifiable->getEmailForVerification()),
            ];

            ksort($params);

            // then create API url for verification. my API have `/api` prefix,
            // so I don't want to show that url to users
            $url = URL::route("care-manager.verification.verify", $params, true);

            // get APP_KEY from config and create signature
            $key = config("app.key");
            $signature = hash_hmac(
                "sha256",
                $url,
                $key
            );

            // generate url for yous SPA page to send it to user
            return config("app.front") .
                "/auth/care-manager/verify-email/" .
                $params["id"] .
                "/" .
                $params["hash"] .
                "?expires=" .
                $params["expires"] .
                "&signature=" .
                $signature;
        });
    }
}
