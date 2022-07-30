<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeyPersonRequest;
use App\Models\KeyPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KeyPersonController extends Controller
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
     * @param  \App\Http\Requests\KeyPersonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeyPersonRequest $request)
    {
        $inputs = $request->all();
        $inputs['password'] = Hash::make($inputs['password']);
        $key_person = KeyPerson::create($inputs);

        return response()->json([
            'message' => 'Store Successfully!',
            'key_person_id' => $key_person->id
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
