<?php

namespace App\Http\Controllers;

use App\Models\HomeCareService;

class HomeCareServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = HomeCareService::get(['id', 'name']);

        return response()->json([
            'data' => $items
        ], 200);
    }
}
