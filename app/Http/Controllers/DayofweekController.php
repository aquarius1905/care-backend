<?php

namespace App\Http\Controllers;

use App\Models\Dayofweek;
use Log;

class DayofweekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Dayofweek::get(['id', 'name']);

        return response()->json([
            'data' => $items
        ], 200);
    }
}
