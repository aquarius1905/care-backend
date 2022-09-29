<?php

namespace App\Http\Controllers\Auth;

use App\Actions\CareReceiver\AttemptToAuthenticate;
use App\Http\Controllers\Controller;
use App\Models\CareReceiver;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Throwable;

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
                    'access_token' => $token,
                    'care_receiver' => $care_receiver
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
        $care_receiver = null;
        $result = false;
        if (Auth::check()) {
            $id = Auth::id();
            $care_receiver = CareReceiver::find($id);
            $result = true;
        }
        return response()->json([
            'result' => $result,
            'care_receiver' => $care_receiver
        ], 200);
    }
}
