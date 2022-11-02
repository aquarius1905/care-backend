<?php

namespace App\Http\Controllers;

use App\Models\DaycareDiary;
use App\Http\Requests\DaycareDiary\StoreRequest;
use App\Http\Requests\DaycareDiary\UpdateSituationAtHomeRequest;
use App\Mail\SituationAtHomeUpdateEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DaycareDiaryController extends Controller
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
     * @param  \App\Http\Requests\DaycareDiary\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $inputs = $request->all();
        DaycareDiary::create($inputs);

        return response()->json([
            'message' => 'Store Successfully!'
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  lluminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DaycareDiary $daycareDiary)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DaycareDiary\UpdateSituationAtHomeRequest
     * @return \Illuminate\Http\Response
     */
    public function updateSituationAtHome(UpdateSituationAtHomeRequest $request)
    {
        $diary = DaycareDiary::find($request->id);
        if (!$diary) {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }

        $diary->situation_at_home = $request->situation_at_home;
        $diary->save();

        $from_email = config('mail.from.address');
        $to_email = array(
            $diary->getCareReceiverEmail(),
            $diary->getNursingCareOfficeEmail()
        );

        Mail::to($to_email)->send(
            new SituationAtHomeUpdateEmail($diary, $from_email)
        );
        return response()->json([
            'message' => 'Update Successfully!'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaycareDiary  $daycareDiary
     * @return \Illuminate\Http\Response
     */
    public function destroy(DaycareDiary $daycareDiary)
    {
        //
    }

    public function search(Request $request)
    {
        $item = DaycareDiary::with(['weekly_service_schedule.care_receiver'])
            ->where(
                'weekly_service_schedule_id',
                $request->weekly_service_schedule_id
            )
            ->where('date', $request->date)
            ->firstOrFail();

        return response()->json([
            'data' => $item
        ], 200);
    }
}
