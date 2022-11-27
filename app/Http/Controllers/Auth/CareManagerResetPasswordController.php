<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CareManagerResetPasswordController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        return redirect(config('app.front') . '/care-manager/reset-password')
            ->with([
                'email' => $request->email,
                'token' => $request->token
            ]);
    }
}
