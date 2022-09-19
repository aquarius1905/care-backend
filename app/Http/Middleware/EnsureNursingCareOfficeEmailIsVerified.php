<?php

namespace App\Http\Middleware;

use Closure;
use App\Contracts\Auth\MustVerifyNursingCareOfficeEmail;

class EnsureNursingCareOfficeEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if (
            !$request->user() ||
            ($request->user() instanceof MustVerifyNursingCareOfficeEmail &&
                !$request->user()->hasVerifiedEmail())
        ) {
            return redirect(config('app.front') . '/email/unverified');
        }

        return $next($request);
    }
}
