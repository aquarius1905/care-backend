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
        $care_receiver = CareReceiver::create($inputs);

        return response()->json([
            'message' => 'Store Successfully!',
            'care_receiver_id' => $care_receiver->id
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
        //
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
    public function destroy($id)
    {
        //
    }
}
