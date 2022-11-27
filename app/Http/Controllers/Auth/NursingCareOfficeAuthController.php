<?php

namespace App\Http\Controllers\Auth;

use App\Actions\NursingCareOffice\AttemptToAuthenticate;
use App\Http\Requests\NursingCareOffice\ForgotPasswordRequest;
use App\Models\NursingCareOffice;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\Password;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Http\Requests\LoginRequest;

class NursingCareOfficeAuthController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            $nursing_care_office
                = NursingCareOffice::where('email', $request->email)
                ->firstOrFail();
            $token = $nursing_care_office
                ->createToken('auth_nursing_care_office_token')
                ->plainTextToken;

            return response()->json([
                'token' => $token,
            ], 200);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        return (new Pipeline(app()))->send($request)->through(array_filter([
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }

    public function me(Request $request)
    {
        return response()->json([
            'data' => auth('sanctum')->user()
        ], 200);
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $status = $this->broker()->sendResetLink(
            $request->only(['email'])
        );

        if ($status == Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Send successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to send email'
            ], 500);
        }
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected function broker(): PasswordBroker
    {
        return Password::broker('nursing_care_offices');
    }
}
