<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
        if ($request->is('*/care-managers/*')) {
            return config('app.front') . ('/care-manager/login');
        } else if ($request->is('*/key-persons/*')) {
            return config('app.front') . ('/key-person/login');
        } else if ($request->is('*/nursing-care-offices/*')) {
            return config('app.front') . ('/nursing-care-office/login');
        } else {
            return config('app.front') . ('/care-manager/login');
        }
    }
}
