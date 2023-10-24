<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Rider;
use Illuminate\Http\Request;

class RiderController extends Controller
{
    public function list(?int $bandId)
    {
        if ($bandId === null) {
            abort(403, 'You must provide a band ID');
        }

        $band = Band::findOrFail($bandId);

        return view('rider.list', [
            'band'   => $band,
            'riders' => Rider::byBand($band)
        ]);
    }

    public function new(?int $bandId)
    {

    }

    public function edit(?int $riderId)
    {

    }

    public function duplicate(?int $riderId)
    {
        
    }

    public function delete(?int $riderId)
    {

    }
}
