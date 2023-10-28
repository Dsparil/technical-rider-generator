<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rider extends Model
{
    use HasFactory;

    protected $fillable = ['band_id', 'title'];

    public static function byBand(Band $band)
    {
        return self::where('band_id', '=', $band->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function band(): BelongsTo
    {
        return $this->belongsTo(Band::class);
    }

    public function patchlists(): HasMany
    {
        return $this->hasMany(Patchlist::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function stuff(): HasMany
    {
        return $this->hasMany(Stuff::class);
    }
}
