<?php

namespace App\Http\Controllers\Auth;

use App\Actions\AttemptToAuthenticate;
use App\Http\Controllers\Controller;
use App\Models\KeyPerson;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Throwable;

class KeyPersonAuthController extends Controller
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
                $key_person = KeyPerson::where('email', $request->email)->firstOrFail();
                $key_person->tokens()->delete();
                $token = $key_person->createToken('auth_key_person_token')->plainTextToken;
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer'
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
        $key_person = null;
        $result = false;
        if (Auth::check()) {
            $id = Auth::id();
            $key_person = KeyPerson::with(['care_receivers'])->find($id);
            $result = true;
        }
        return response()->json([
            'result' => $result,
            'key_person' => $key_person
        ], 200);
    }
}
