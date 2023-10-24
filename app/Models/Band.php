<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    use HasFactory;
    
    public static function allOrdered()
    {
        return self::orderBy('name')->get();
    }
}
