<?php

namespace App\Http\Controllers;

use App\Http\Requests\CareReceiverRequest;
use App\Models\CareReceiver;
use App\Models\KeyPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class CareReceiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $column = $this->getSearchTargetColumn();
        if (!$column) {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }

        $login_id = Auth::id();
        $items = CareReceiver::with([
            'care_level:id,name',
            'key_person',
            'visit_datetime:care_receiver_id,date,time'
        ])->where($column, $login_id)->get();

        return response()->json([
            'data' => $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CareReceiverRequest $request)
    {
        $inputs = $request->all();
        $inputs['care_manager_id'] = Auth::id();
        CareReceiver::create($inputs);

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
        $item = CareReceiver::with(['care_level:id,name', 'key_person'])
            ->find($id);
        if ($item) {
            return response()->json([
                'data' => $item
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CareReceiver  $care_receiver
     * @return \Illuminate\Http\Response
     */
    public function destroy(CareReceiver $care_receiver)
    {
        $count = CareReceiver::where('key_person_id', $care_receiver->key_person_id)
            ->count();
        if ($count === 1) {
            KeyPerson::where('id', $care_receiver->key_person_id)->delete();
        }

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

    public function batchDelete(Request $request_ids)
    {
        foreach ($request_ids as $id) {
            $care_receiver = CareReceiver::find($id);
            if (!$care_receiver) {
                continue;
            }
            if ($care_receiver->getKeyPersonCount() === 1) {
                $care_receiver->key_person()->delete();
            }
            $care_receiver->delete();
        }
        return response()->json([
            'message' => 'Deleted successfully',
        ], 200);
    }

    private function getSearchTargetColumn()
    {
        if (Auth::guard('care-manager')) {
            return 'care_manager_id';
        } else if (Auth::guard('key-person')) {
            return 'key_person_id';
        }
        return null;
    }
}
