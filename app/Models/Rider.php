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

    public function hasSceneMap(): bool
    {
        $data = json_decode($this->scene_map_json, true);

        if (isset($data['objects']) && is_array($data['objects']) && count($data['objects']) > 0) {
            return true;
        }

        return false;
    }

    public function getAllStuff()
    {
        $result = [];

        foreach (Stuff::enumValues() as $section => $label) {
            $sectionContents = $this->stuff->filter->isSection($section);

            if (count($sectionContents) > 0) {
                $result[$section] = $sectionContents;
            }
        }

        return $result;
    }

    public function cloneAll(): self
    {
        $clone = $this->replicate();
        $clone->title .= ' (copie)';
        $clone->push();

        foreach ($this->sections as $item) {
            $cloned = $item->replicate();
            $clone->sections()->save($cloned);
        }

        foreach ($this->patchlists as $item) {
            $cloned = $item->replicate();
            $clone->patchlists()->save($cloned);
        }

        foreach ($this->stuff as $item) {
            $cloned = $item->replicate();
            $clone->stuff()->save($cloned);
        }

        return $clone;
    }
}
