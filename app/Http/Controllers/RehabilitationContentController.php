<?php

namespace App\Http\Controllers;

use App\Models\RehabilitationContent;
use Illuminate\Http\Request;

class RehabilitationContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = RehabilitationContent::all();

        return response()->json([
            'data' => $items
        ], 200);
    }
}
