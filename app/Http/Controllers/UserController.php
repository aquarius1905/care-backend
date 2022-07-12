<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class UserController extends Controller
{
    /**
     * Create a new registered user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\CreatesNewUsers  $creator
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        CreatesNewUsers $creator
    ) {
        event(new Registered($creator->create($request->all())));
        return response()->json([
            'message' => 'Store sucessfully!'
        ], 201);
    }
}
