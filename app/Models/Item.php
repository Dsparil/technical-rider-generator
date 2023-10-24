<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public const TYPE_INSTRUMENT = 'instrument';
    public const TYPE_AMP        = 'amp';
    public const TYPE_CAB        = 'cab';
    public const TYPE_PLUG       = 'plug';
    public const TYPE_OTHER      = 'other';

    public const ENUM = [
        self::TYPE_INSTRUMENT,
        self::TYPE_AMP,
        self::TYPE_CAB,
        self::TYPE_PLUG,
        self::TYPE_OTHER,
    ];

    use HasFactory;
}
