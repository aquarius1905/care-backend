<?php

namespace App\Http\Controllers;

use App\Models\CareLevel;

class CareLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = CareLevel::get(['id', 'name']);

        return response()->json([
            'data' => $items->toArray()
        ], 200);
    }
}
