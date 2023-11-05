<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stuff extends AbstractModelSaveProcess
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

    public function fillFromForm(array $data, string $id)
    {
        $this->member_id = $data['member_id'];
        $this->section   = $data['section'];
        $this->label     = $data['label'];
        $this->content   = $data['content'];
    }

    public static function enumValues()
    {
        return [
            self::TYPE_NEEDED           => 'Requis',
            self::TYPE_OPTIONAL         => 'Optionnel',
            self::TYPE_BROUGHT          => 'Apporté',
            self::TYPE_BROUGHT_OPTIONAL => 'Apporté (optionnel)',
        ];
    }

    public static function byRider(Rider $rider)
    {
        return self::where('rider_id', '=', $rider->id)->get();
    }

    public function rider(): BelongsTo
    {
        return $this->belongsTo(Rider::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function isSection(string $sectionCode): bool
    {
        return $this->section == $sectionCode;
    }
}
