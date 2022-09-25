<?php

namespace App\Http\Middleware;

use Closure;
use App\Contracts\Auth\MustVerifyNursingCareOfficeEmail;
use App\Models\NursingCareOffice;

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
        $nursing_care_office
            = NursingCareOffice::where('email', $request->email)->firstOrFail();
        if (
            !$nursing_care_office ||
            ($nursing_care_office instanceof MustVerifyNursingCareOfficeEmail &&
                !$nursing_care_office->hasVerifiedEmail())
        ) {
            return abort(403, 'Your email address is not verified.');
        }

        return $next($request);
    }
}
