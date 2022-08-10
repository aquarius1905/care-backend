<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitDatetimeRequest;
use App\Models\VisitDatetime;
use Illuminate\Http\Request;

class VisitDatetimeController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitDatetimeRequest $request)
    {
        $inputs = $request->all();
        VisitDatetime::create($inputs);

        return response()->json([
            'message' => 'Store Successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisitDatetime  $visitDatetime
     * @return \Illuminate\Http\Response
     */
    public function show(VisitDatetime $visitDatetime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisitDatetime  $visitDatetime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitDatetime $visitDatetime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitDatetime  $visitDatetime
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitDatetime $visitDatetime)
    {
        //
    }
}
