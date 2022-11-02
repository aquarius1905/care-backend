<?php

namespace App\Http\Controllers;

use App\Models\Cancellation;
use App\Http\Requests\Cancellation\StoreRequest;
use App\Mail\CancellationNotificationMail;
use App\Mail\CancellationRegistrationNoticeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CancellationController extends Controller
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
     * @param  \App\Http\Requests\Cancellation\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $inputs = $request->all();
        $cancellation = Cancellation::create($inputs);

        $this->sendMail($cancellation);

        return response()->json([
            'message' => 'Store Successfully!',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cancellation  $cancellation
     * @return \Illuminate\Http\Response
     */
    public function show(Cancellation $cancellation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cancellation  $cancellation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cancellation $cancellation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cancellation  $cancellation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cancellation $cancellation)
    {
        //
    }

    private function sendMail($cancellation)
    {
        $from_email = config('mail.from.address');
        $to_email = array(
            $cancellation->getCareManagerEmail(),
            $cancellation->getNursingCareOfficeEmail()
        );

        Mail::to($to_email)->send(
            new CancellationNotificationMail($cancellation, $from_email)
        );

        Mail::to($cancellation->getCareReceiverEmail())->send(
            new CancellationRegistrationNoticeMail($cancellation, $from_email)
        );
    }
}
