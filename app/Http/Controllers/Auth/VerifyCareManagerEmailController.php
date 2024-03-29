<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\CareManager;

class VerifyCareManagerEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $care_manager = CareManager::findOrFail($request->id);

        if (!hash_equals(
            (string) $request->hash,
            sha1($care_manager->getEmailForVerification())
        )) {
            return redirect(config('app.url') . '/email/verify/failure');
        }

        if ($care_manager->hasVerifiedEmail()) {
            return redirect(config('app.url') . '/email/already-verified');
        }

        if ($care_manager->markEmailAsVerified()) {
            event(new Verified($care_manager));
        }

        return redirect(config('app.url') . '/email/verified');
    }
}
