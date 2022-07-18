<?php

namespace App\Http\Controllers;

use App\Models\CareLevel;
use Illuminate\Http\Request;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CareLevel  $careLevel
     * @return \Illuminate\Http\Response
     */
    public function show(CareLevel $careLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CareLevel  $careLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CareLevel $careLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CareLevel  $careLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CareLevel $careLevel)
    {
        //
    }
}
