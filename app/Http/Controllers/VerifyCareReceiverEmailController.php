<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\CareReceiver;

class VerifyCareReceiverEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $care_receiver = CareReceiver::findOrFail($request->id);

        if (!hash_equals(
            (string) $request->hash,
            sha1($care_receiver->getEmailForVerification())
        )) {
            return redirect(config('app.front') . '/email/verify/failure');
        }

        if ($care_receiver->hasVerifiedEmail()) {
            return redirect(config('app.front') . '/email/already-verified');
        }

        if ($care_receiver->markEmailAsVerified()) {
            event(new Verified($care_receiver));
        }

        return redirect(config('app.front') . '/email/verified');
    }
}
