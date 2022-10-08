<?php

namespace App\Http\Controllers;

use App\Models\WeeklyServiceSchedule;
use App\Http\Requests\WeeklyServiceSchedule\StoreRequest;
use Illuminate\Http\Request;

class WeeklyServiceScheduleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\WeeklyServiceSchedule\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $inputs = $request->all();
        $weekly_service_schedule = WeeklyServiceSchedule::create($inputs);
        $item = WeeklyServiceSchedule::with([
            'nursing_care_office.service_type'
        ])->find($weekly_service_schedule->id);

        return response()->json([
            'message' => 'Store Successfully!',
            'data' => $item
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WeeklyServiceSchedule  $weeklyServiceSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(WeeklyServiceSchedule $weeklyServiceSchedule)
    {
    }

    public function showByCareReceiverId(Request $request)
    {
        $items = WeeklyServiceSchedule::with([
            'nursing_care_office.service_type',
        ])
            ->where('care_receiver_id', $request->care_receiver_id)
            ->orderBy('dayofweek_id')
            ->get();

        return response()->json([
            'data' => $items
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WeeklyServiceSchedule  $weeklyServiceSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WeeklyServiceSchedule $weeklyServiceSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WeeklyServiceSchedule  $weeklyServiceSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeeklyServiceSchedule $weeklyServiceSchedule)
    {
        $result = WeeklyServiceSchedule::where(
            'id',
            $weeklyServiceSchedule->id
        )->delete();

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

    public function searchByNursingCareOfficeId(Request $request)
    {
        $items = WeeklyServiceSchedule::with(['care_receiver'])
            ->where('nursing_care_office_id', auth('sanctum')->id())
            ->where('dayofweek_id', $request->dayofweek)
            ->get();

        return response()->json([
            'data' => $items
        ], 200);
    }
}
