<?php

namespace App\Http\Controllers;

use App\Models\DaycareDiary;
use App\Http\Requests\DaycareDiary\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DaycareDiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DaycareDiary\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Log::Debug($request);
        $inputs = $request->all();
        DaycareDiary::create($inputs);

        return response()->json([
            'message' => 'Store Successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaycareDiary  $daycareDiary
     * @return \Illuminate\Http\Response
     */
    public function show(DaycareDiary $daycareDiary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaycareDiary  $daycareDiary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DaycareDiary $daycareDiary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaycareDiary  $daycareDiary
     * @return \Illuminate\Http\Response
     */
    public function destroy(DaycareDiary $daycareDiary)
    {
        //
    }
}
