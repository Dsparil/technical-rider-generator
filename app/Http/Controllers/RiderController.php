<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Item;
use App\Models\Member;
use App\Models\Patchlist;
use App\Models\Rider;
use App\Models\Section;
use App\Models\Stuff;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use File;
// use PDF;

class RiderController extends Controller
{
    public function list(?int $bandId)
    {
        if ($bandId === null) {
            abort(403, 'You must provide a band ID');
        }

        $band = Band::findOrFail($bandId);

        return view('rider.list', [
            'page'   => 'riders',
            'band'   => $band,
            'riders' => Rider::byBand($band)
        ]);
    }

    public function new(?int $bandId, Request $request)
    {
        Rider::create([
            'band_id' => $bandId,
            'title'   => $request->post('title')
        ]);

        return back();
    }

    private function save(Rider $rider, Request $request)
    {
        $param = ['rider_id' => $rider->id];

        Patchlist::saveProcess($request->post('patchlist') ?? [], $param);
        Stuff::saveProcess($request->post('stuff') ?? [],         $param);
        Section::saveProcess($request->post('section') ?? [],     $param);
        Item::saveProcess($request->post('items') ?? []);

        $rider->scene_map_json     = $request->post('scenemap-json');
        $rider->scene_map_snapshot = $request->post('scenemap-snapshot');

        $rider->save();
    }

    public function preview(?int $riderId)
    {
        $rider = Rider::findOrFail($riderId);

        return view('rider.pdf', ['rider' => $rider]);
    }

    public function download(?int $riderId)
    {
        $rider = Rider::findOrFail($riderId);
        set_time_limit(0);

        $pdf = Pdf::loadView('rider.pdf', ['rider' => $rider]);

        return $pdf->download($rider->band->name.'_rider_'.date('Ymd').'.pdf');
    }

    /*
    public function download(?int $riderId)
    {
        $rider = Rider::findOrFail($riderId);

        $pdf = PDF::loadView('rider.pdf', ['rider' => $rider]);

        return $pdf->download($rider->band->name.'_rider_'.date('Ymd'));
    }
    */

    public function edit(?int $riderId, Request $request)
    {
        $rider = Rider::findOrFail($riderId);

        if ($request->isMethod('post')) {
            $this->save($rider, $request);

            return back();
        }

        $activeTab = 'scenemap';

        return view('rider.edit', [
            'activeTab' => $activeTab,
            'rider'     => $rider,
            'patchlist' => Patchlist::byRider($rider),
            'stuff'     => Stuff::byRider($rider),
            'sections'  => Section::byRider($rider),
            'items'     => Item::getAllOrdered(),
            'members'   => Member::byBand($rider->band),
        ]);
    }

    public function duplicate(?int $riderId)
    {

    }

    public function delete(?int $riderId)
    {
        Rider::destroy($riderId);

        return back();
    }
}
