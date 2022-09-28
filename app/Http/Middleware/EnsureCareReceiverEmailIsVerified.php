<?php

namespace App\Http\Middleware;

use Closure;
use App\Contracts\Auth\MustVerifyCareReceiverEmail;
use App\Models\CareReceiver;

class EnsureCareReceiverEmailIsVerified
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
        $care_receiver
            = CareReceiver::where('email', $request->email)->firstOrFail();
        if (
            !$care_receiver ||
            ($care_receiver instanceof MustVerifyCareReceiverEmail &&
                !$care_receiver->hasVerifiedEmail())
        ) {
            return abort(403, 'Your email address is not verified.');
        }

        return $next($request);
    }
}
