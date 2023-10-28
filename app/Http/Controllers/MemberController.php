<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function list(?int $bandId, Request $request)
    {
        if ($bandId === null) {
            abort(403, 'You must provide a band ID');
        }

        $band = Band::findOrFail($bandId);

        if ($request->ajax()) {
            return response()->json(Member::byBand($band));
        }

        return view('member.list', [
            'page'    => 'members',
            'band'    => $band,
            'members' => Member::byBand($band)
        ]);
    }

    public function save(?int $bandId, Request $request)
    {
        if ($bandId === null) {
            abort(403, 'You must provide a band ID');
        }

        $band = Band::findOrFail($bandId);

        Member::saveProcess($request->post('members'), ['band_id' => $band->id]);

        return back();
    }
}
