<?php

namespace App\Http\Controllers;

use App\Models\Stuff;
use Illuminate\Http\Request;

class StuffController extends Controller
{
    public function enum()
    {
        return response()->json(Stuff::enumValues());
    }
}
