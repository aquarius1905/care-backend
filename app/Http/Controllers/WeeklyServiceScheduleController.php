<?php

namespace App\Http\Controllers;

use App\Models\WeeklyServiceSchedule;
use App\Models\Dayofweek;
use App\Models\ServiceType;
use App\Http\Requests\WeeklyServiceSchedule\StoreRequest;
use Illuminate\Http\Request;

class WeeklyServiceScheduleController extends Controller
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
     * @param  \App\Http\Requests\WeeklyServiceSchedule\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $inputs = $request->all();
        WeeklyServiceSchedule::create($inputs);

        return response()->json([
            'message' => 'Store Successfully!'
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
        //
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
        //
    }

    public function getDayofweeksAndServiceTypes()
    {
        $day_of_weeks = Dayofweek::get(['id', 'name']);
        $service_types = ServiceType::with(['nursing_care_offices'])
            ->get(['id', 'name']);

        return response()->json([
            'day_of_weeks' => $day_of_weeks,
            'service_types' => $service_types,
        ], 200);
    }
}
