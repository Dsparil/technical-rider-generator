<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    public const TYPE_NEEDED           = 'needed';
    public const TYPE_OPTIONAL         = 'optinal';
    public const TYPE_BROUGHT          = 'brought';
    public const TYPE_BROUGHT_OPTIONAL = 'brought_optional';

    public const ENUM = [
        self::TYPE_NEEDED,
        self::TYPE_OPTIONAL,
        self::TYPE_BROUGHT,
        self::TYPE_BROUGHT_OPTIONAL,
    ];

    use HasFactory;
}
