<?php

namespace App\Http\Middleware;

use Closure;
use App\Contracts\Auth\MustVerifyCareManagerEmail;
use App\Models\CareManager;

class EnsureCareManagerEmailIsVerified
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
        $care_manager
            = CareManager::where('email', $request->email)->firstOrFail();
        if (
            !$care_manager ||
            ($care_manager instanceof MustVerifyCareManagerEmail &&
                !$care_manager->hasVerifiedEmail())
        ) {
            return abort(403, 'Your email address is not verified.');
        }

        return $next($request);
    }
}
