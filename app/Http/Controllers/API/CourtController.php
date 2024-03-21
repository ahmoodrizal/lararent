<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index()
    {
        $courts = Court::whereIsActive(true)->orderBy('type')->get();

        return response()->json([
            'message' => 'Success',
            'courts' => $courts
        ], 200);
    }
}
