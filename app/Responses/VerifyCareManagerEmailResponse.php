<?php

namespace App\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\VerifyEmailResponse as VerifyEmailResponseContract;

class VerifyCareManagerEmailResponse implements VerifyEmailResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = Auth::user();
        return $request->wantsJson()
            ? response()->json($user, 200) //ログイン後user情報とレスポンスステータスOKを渡す
            : redirect()->intended(Fortify::redirects('login'));
    }
}
