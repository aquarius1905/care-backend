<?php

namespace App\Http\Controllers;

use App\Models\NursingCareOffice;
use App\Auth\Events\NursingCareOfficeRegistered;
use App\Http\Requests\NursingCareOffice\StoreRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class NursingCareOfficeController extends Controller
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
     * @param  \App\Http\Requests\NursingCareOffice\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $inputs = $request->except(['_token']);
        $inputs['password'] = Hash::make($inputs['password']);

        $item = NursingCareOffice::create($inputs);

        event(new NursingCareOfficeRegistered($item));

        return response()->json([
            'message' => 'Store Successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NursingCareOffice  $nursingCareOffice
     * @return \Illuminate\Http\Response
     */
    public function show(NursingCareOffice $nursingCareOffice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NursingCareOffice  $nursingCareOffice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NursingCareOffice $nursingCareOffice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NursingCareOffice  $nursingCareOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy(NursingCareOffice $nursingCareOffice)
    {
        //
    }
}
