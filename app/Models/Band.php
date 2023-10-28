<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
