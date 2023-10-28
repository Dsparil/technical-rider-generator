<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Member extends AbstractModelSaveProcess
{
    use HasFactory;

    public function fillFromForm(array $data, string $id)
    {
        $this->name      = $data['name'];
        $this->role      = $data['role'];
        $this->allergies = $data['allergies'];

        /** @var UploadedFile $imageObject */
        $imageObject = request()->file('members')[$id]['picture'] ?? null;

        $this->save();

        if ($imageObject !== null) {
            $fileName = 'member_'.$this->id.'.jpg';

            $imageObject->storePubliclyAs('public/members', $fileName);

            $this->picture = asset('storage/members/'.$fileName);
        }
    }

    public static function byBand(Band $band)
    {
        return self::where('band_id', '=', $band->id)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function band(): BelongsTo
    {
        return $this->belongsTo(Band::class);
    }

    public function stuff(): HasMany
    {
        return $this->hasMany(Stuff::class);
    }
}
