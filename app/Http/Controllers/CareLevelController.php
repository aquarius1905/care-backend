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
        $items = CareLevel::all();

        return response()->json([
            'data' => $items
        ], 200);
    }
}
