<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Routing\Controller;
use Laravel\Fortify\Http\Requests\VerifyEmailRequest;

class VerifyCareManagerEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Laravel\Fortify\Http\Requests\VerifyEmailRequest  $request
     * @return \App\Responses\VerifyCareManagerEmailResponse
     */
    public function __invoke(VerifyEmailRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json($request);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json($request);
    }
}
