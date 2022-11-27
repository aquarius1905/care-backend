<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\NursingCareOffice;

class VerifyNursingCareOfficeEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Responses\VerifyCareManagerEmailResponse
     */
    public function __invoke(Request $request)
    {
        $nursing_care_office = NursingCareOffice::findOrFail($request->id);

        if (!hash_equals(
            (string) $request->hash,
            sha1($nursing_care_office->getEmailForVerification())
        )) {
            return redirect(config('app.front') . '/email/verify/failure');
        }

        if ($nursing_care_office->hasVerifiedEmail()) {
            return redirect(config('app.front') . '/email/already-verified');
        }

        if ($nursing_care_office->markEmailAsVerified()) {
            event(new Verified($nursing_care_office));
        }

        return redirect(config('app.front') . '/email/verified');
    }
}
