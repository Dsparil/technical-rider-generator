<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patchlist extends Model
{
    public const MIC_STAND_NONE   = 'none';
    public const MIC_STAND_SMALL  = 'small';
    public const MIC_STAND_MEDIUM = 'medium';
    public const MIC_STAND_TALL   = 'tall';

    public const ENUM = [
        self::MIC_STAND_NONE,
        self::MIC_STAND_SMALL,
        self::MIC_STAND_MEDIUM,
        self::MIC_STAND_TALL,
    ];

    use HasFactory;
}
