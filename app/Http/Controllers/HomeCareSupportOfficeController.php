<?php

namespace App\Http\Controllers;

use App\Models\HomeCareSupportOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeCareSupportOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = HomeCareSupportOffice::get(['id', 'name']);

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
     * @param  \App\Models\HomeCareSupportOffice  $homeCareSupportOffice
     * @return \Illuminate\Http\Response
     */
    public function show(HomeCareSupportOffice $homeCareSupportOffice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeCareSupportOffice  $homeCareSupportOffice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeCareSupportOffice $homeCareSupportOffice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeCareSupportOffice  $homeCareSupportOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeCareSupportOffice $homeCareSupportOffice)
    {
        //
    }
}
