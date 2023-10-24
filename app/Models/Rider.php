<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;

    public static function byBand(Band $band)
    {
        return self::where('band_id', '=', $band->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
