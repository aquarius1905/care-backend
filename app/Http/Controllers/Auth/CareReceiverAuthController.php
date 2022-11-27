<?php

namespace App\Http\Controllers\Auth;

use App\Actions\CareReceiver\AttemptToAuthenticate;
use App\Http\Controllers\Controller;
use App\Http\Requests\CareReceiver\ForgotPasswordRequest;
use App\Models\CareReceiver;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\Password;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Throwable;
use DateTime;

class CareReceiverAuthController extends Controller
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
        return $this->loginPipeline($request)
            ->then(function ($request) {
                $care_receiver = CareReceiver::where('email', $request->email)->firstOrFail();
                $care_receiver->tokens()->delete();
                $token = $care_receiver->createToken('auth_carereceiver_token')->plainTextToken;

                return response()->json([
                    'token' => $token
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
        try {
            return (new Pipeline(app()))->send($request)->through(array_filter([
                AttemptToAuthenticate::class
            ]));
        } catch (Throwable $e) {
            throw $e;
        }
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
        $care_receiver = auth('sanctum')->user()->load(
            ['care_level', 'care_manager', 'visit_datetime', 'weekly_service_schedules']
        );
        if ($care_receiver->visit_datetime !== null) {

            $visit_date = $care_receiver->visit_datetime->date->format('Y-m-d');
            $today = new DateTime();
            $today = $today->format('Y-m-d');

            if ($visit_date < $today) {
                unset($care_receiver['visit_datetime']);
            }
        }

        return response()->json([
            'data' => $care_receiver
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
        return Password::broker('care_receivers');
    }
}
