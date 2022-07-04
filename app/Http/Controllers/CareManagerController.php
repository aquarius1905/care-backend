<?php

namespace App\Http\Controllers;

use App\Http\Requests\CareManagerRegisterRequest;
use App\Auth\Events\CareManagerRegistered;
use App\Models\CareManager;
use Illuminate\Http\Request;
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
     * @param  \App\Http\Requests\CareManagerRegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CareManagerRegisterRequest $request)
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
    public function update(Request $request, CareManager $careManager)
    {
        //
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
