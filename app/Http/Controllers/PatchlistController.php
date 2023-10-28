<?php

namespace App\Http\Controllers;

use App\Models\Patchlist;
use Illuminate\Http\Request;

class PatchlistController extends Controller
{
    public function enum()
    {
        return response()->json(Patchlist::enumValues());
    }
}
