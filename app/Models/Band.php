<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Band extends Model
{
    use HasFactory;
    
    public static function allOrdered()
    {
        return self::orderBy('name')->get();
    }

    public function riders(): HasMany
    {
        return $this->hasMany(Rider::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function base64Logo(): string
    {
        if (empty($this->logo)) {
            return '';
        }

        $bandLogo = Storage::get('public/logos/'.$this->logo);
        $type = pathinfo($this->logo, PATHINFO_EXTENSION);

        return 'data:image/' . $type . ';base64,' . base64_encode($bandLogo);
    }
}
