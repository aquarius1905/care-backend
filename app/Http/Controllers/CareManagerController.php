<?php

namespace App\Http\Controllers;

use App\Http\Requests\CareManagerRequest;
use App\Auth\Events\CareManagerRegistered;
use App\Models\CareManager;
use Illuminate\Support\Facades\Hash;

class CareManagerController extends Controller
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
     * @param  \App\Http\Requests\CareManagerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CareManagerRequest $request)
    {
        $inputs = $request->except(['_token']);
        $inputs['password'] = Hash::make($inputs['password']);
        $care_manager = CareManager::create($inputs);
        event(new CareManagerRegistered($care_manager));

        return response()->json([
            'message' => 'Store Successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CareManager  $careManager
     * @return \Illuminate\Http\Response
     */
    public function show(CareManager $careManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CareManager  $careManager
     * @return \Illuminate\Http\Response
     */
    public function update(CareManagerRequest $request, CareManager $careManager)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CareManager  $careManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(CareManager $careManager)
    {
        //
    }
}
