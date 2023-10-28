<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patchlist extends AbstractModelSaveProcess
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

    public function fillFromForm(array $data, string $id)
    {
        $this->number           = $data['number'];
        $this->member_id        = $data['member_id'];
        $this->instrument       = $data['instrument'];
        $this->microphone       = $data['microphone'];
        $this->microphone_stand = $data['microphone_stand'];
    }

    public static function byRider(Rider $rider)
    {
        return self::where('rider_id', '=', $rider->id)
            ->orderBy('number', 'asc')
            ->get();
    }

    public static function enumValues()
    {
        return [
            self::MIC_STAND_NONE   => 'Aucun',
            self::MIC_STAND_SMALL  => 'Petit',
            self::MIC_STAND_MEDIUM => 'Moyen',
            self::MIC_STAND_TALL   => 'Grand',
        ];
    }

    public function rider(): BelongsTo
    {
        return $this->belongsTo(Rider::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
