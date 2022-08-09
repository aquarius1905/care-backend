<?php

namespace App\Http\Controllers;

use App\Http\Requests\CareManagerRequest;
use App\Http\Requests\CareManagerUpdateRequest;
use App\Auth\Events\CareManagerRegistered;
use App\Models\CareManager;
use Illuminate\Support\Facades\Hash;
use Log;

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
        $inputs = $request->all();
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
     * @param  \App\Http\Requests\CareManagerUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CareManagerUpdateRequest $request, int $id)
    {
        $inputs = $request->only([
            'home_care_support_office_id',
            'name',
            'name_furigana',
            'registration_number',
            'email',
            'tel'
        ]);

        $result = CareManager::where('id', $id)->update($inputs);
        if ($result) {
            return response()->json([
                'message' => 'Updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CareManager  $careManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(CareManager $careManager)
    {
    }
}
