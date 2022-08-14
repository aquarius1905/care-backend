<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitDatetimeRequest;
use App\Mail\VisitDateTimeNotificationMail;
use App\Models\CareReceiver;
use App\Models\VisitDatetime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VisitDatetimeController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitDatetimeRequest $request)
    {
        $inputs = $request->all();
        $care_receiver_id = $inputs['care_receiver_id'];
        $this->destroy($care_receiver_id);
        VisitDatetime::create($inputs);

        $this->sendMail($care_receiver_id);

        return response()->json([
            'message' => 'Store Successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisitDatetime  $visitDatetime
     * @return \Illuminate\Http\Response
     */
    public function show(VisitDatetime $visitDatetime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisitDatetime  $visitDatetime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitDatetime $visitDatetime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $care_receiver_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($care_receiver_id)
    {
        $result = VisitDatetime::where('care_receiver_id', $care_receiver_id)->delete();

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

    private function sendMail($care_receiver_id)
    {
        $care_receiver = CareReceiver::find($care_receiver_id);

        $from_email = config('mail.from.address');
        $to_email = $care_receiver->getKeyPersonEmail();

        Mail::to($to_email)->send(
            new VisitDateTimeNotificationMail($care_receiver, $from_email)
        );
    }
}
