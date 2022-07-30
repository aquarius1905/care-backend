<?php

namespace App\Http\Controllers;

use App\Http\Requests\CareReceiverRequest;
use App\Models\CareReceiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CareReceiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $care_manager_id = Auth::id();
        $items = CareReceiver::with('care_level')
            ->where('care_manager_id', $care_manager_id)
            ->get();

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
        $item = CareReceiver::with(['care_level', 'key_person'])
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CareReceiver $care_receiver)
    {
        $count = $care_receiver->key_persons()->count();
        if ($count === 1) {
            $care_receiver->key_persons()->delete();
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
}
