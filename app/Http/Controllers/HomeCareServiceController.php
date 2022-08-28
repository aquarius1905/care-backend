<?php

namespace App\Http\Controllers;

use App\Models\HomeCareService;
use Illuminate\Http\Request;

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HomeCareService  $homeCareService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeCareService $homeCareService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HomeCareService  $homeCareService
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeCareService $homeCareService)
    {
        //
    }
}
