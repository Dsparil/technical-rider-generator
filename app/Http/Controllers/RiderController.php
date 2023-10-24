<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Rider;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    public function list(Request $request)
    {
        $bandId = $request->get('bandId');

        if ($bandId === null) {
            abort(403, 'You must provide a band ID');
        }

        return view('rider.list', [
            'riders' => Rider::byBand(Band::findOrFail($bandId))
        ]);
    }
}
