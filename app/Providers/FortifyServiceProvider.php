<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use App\Models\User;
use App\Models\Manager;
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
            if (preg_match("/managers/", $url)) {
                $user = Manager::where('email', $request->email)->first();
            } else if (preg_match("/providers/", $url)) {
                $user = Provider::where('email', $request->email)->first();
            } else {
                $user = User::where('email', $request->email)->first();
            }
            if (
                $user &&
                Hash::check($request->password, $user->password)
            ) {
                return $user;
            } else {
                throw ValidationException::withMessages([
                    'login_error' => "メールアドレス・パスワードが一致しません"
                ]);
            }
        });
    }
}
