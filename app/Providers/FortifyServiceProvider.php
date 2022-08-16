<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\CareManager;
use App\Models\KeyPerson;
use App\Models\Provider;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::authenticateUsing(function (Request $request) {
            $url = url()->current();
            $user = null;
            if (preg_match("/care-managers/", $url)) {
                $user = CareManager::where('email', $request->email)->first();
            } else if (preg_match("/providers/", $url)) {
                $user = Provider::where('email', $request->email)->first();
            } else if (preg_match("/key-persons/", $url)) {
                $user = KeyPerson::where('email', $request->email)->first();
            }
            if (
                $user &&
                Hash::check($request->password, $user->password)
            ) {
                return $user;
            } else {
                return null;
            }
        });
    }
}
