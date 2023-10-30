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

    private function save(Band $band, Request $request)
    {
        $fields = [
            'name',
            'style',
            'birth_year',
            'label',
            'location',
            'spoken_languages',
            'description',
            'staff',
            'link_fb',
            'link_ig',
            'link_yt'
        ];

        foreach ($fields as $field) {
            $band->$field = $request->post('band-'.$field);
        }

        $imageObject = $request->file('band-logo') ?? null;

        if ($imageObject !== null) {
            $fileName = 'band_'.$band->id.'.'.$imageObject->clientExtension();

            $imageObject->storePubliclyAs('public/logos', $fileName);

            $band->logo = $fileName;
        }
        
        $band->save();
    }

    public function edit(int $bandId, Request $request)
    {
        $band = Band::findOrFail($bandId);

        if ($request->isMethod('post')) {
            $this->save($band, $request);

            return back();
        }

        return view('band.edit', [
            'page' => 'informations',
            'band' => $band
        ]);
    }

    public function new()
    {
        
    }
}
