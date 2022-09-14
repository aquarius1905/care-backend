<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ServiceType::get(['id', 'name']);

        return response()->json([
            'data' => $items
        ], 200);
    }
}
