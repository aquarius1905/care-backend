<?php

namespace App\Http\Controllers;

use App\Auth\Events\CareReceiverRegistered;
use App\Http\Requests\CareReceiver\StoreRequest;
use App\Http\Requests\CareReceiver\UpdateRequest;
use App\Models\CareReceiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Log;
use DateTime;

class CareReceiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->getCareReceivers();

        return response()->json([
            'data' => $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CareReceiver\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $inputs = $request->all();
        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['care_manager_id'] = Auth::guard('sanctum')->id();
        $care_receiver = CareReceiver::create($inputs);
        event(new CareReceiverRegistered($care_receiver));

        return response()->json([
            'message' => 'Store Successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CareReceiver\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $email_update = CareReceiver::where('email', $request->email)->doesntExist();
        if ($email_update) {
            $inputs['email_verified_at'] = null;
        }

        $inputs = $request->only([
            'name',
            'name_furigana',
            'post_code',
            'address',
            'insurer_number',
            'insured_number',
            'care_level_id',
            'keyperson_name',
            'keyperson_name_furigana',
            'relationship',
            'email',
            'tel'
        ]);

        $result = CareReceiver::where('id', $id)->update($inputs);

        if ($email_update) {
            $item = CareReceiver::find($id);
            event(new CareReceiverRegistered($item));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CareReceiver  $care_receiver
     * @return \Illuminate\Http\Response
     */
    public function destroy(CareReceiver $care_receiver)
    {
        $result = CareReceiver::where('id', $care_receiver->id)->delete();

        if ($result) {
            return response()->json([
                'message' => 'Deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    public function batchDelete(Request $request)
    {
        foreach ($request->ids as $key => $id) {
            CareReceiver::find($id)->delete();
        }

        $items = $this->getCareReceivers();

        return response()->json([
            'message' => 'Deleted successfully',
            'data' => $items
        ], 200);
    }

    private function getCareReceivers()
    {
        $care_manager_id = auth('sanctum')->id();

        $items = CareReceiver::where(
            'care_manager_id',
            $care_manager_id
        )->get();

        $today = new Datetime();
        $today = $today->format('Y-m-d');
        foreach ($items as $item) {
            if ($item->visit_datetime == null) {
                continue;
            }
            $visit_date = $item->visit_datetime->date->format('Y-m-d');
            if ($today <= $visit_date) {
                continue;
            }
            unset($item['visit_datetime']);
        }

        return $items;
    }
}
