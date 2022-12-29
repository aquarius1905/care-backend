<?php

namespace App\Http\Controllers;

use App\Models\NursingCareOffice;
use App\Auth\Events\NursingCareOfficeRegistered;
use App\Http\Requests\NursingCareOffice\StoreRequest;
use App\Http\Requests\NursingCareOffice\UpdateRequest;
use Illuminate\Support\Facades\Hash;

class NursingCareOfficeController extends Controller
{
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
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NursingCareOffice\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, int $id)
    {
        $inputs = $request->except([
            'password',
            'password_confirmation',
            'service_type'
        ]);

        if ($request->password) {
            $inputs['password'] = Hash::make($request->password);
        }

        $email_update = NursingCareOffice::where('email', $request->email)->doesntExist();
        if ($email_update) {
            $inputs['email_verified_at'] = null;
        }

        $result = NursingCareOffice::where('id', $id)->update($inputs);

        if ($email_update) {
            $item = NursingCareOffice::find($id);
            event(new NursingCareOfficeRegistered($item));
        }
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
}
