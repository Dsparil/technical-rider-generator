<?php

namespace App\Http\Controllers;

use App\Models\Band;
use Illuminate\Http\Request;

class BandController extends Controller
{
    public function list(Request $request)
    {
        return view('band.list', ['bands' => Band::allOrdered()]);
    }
}
