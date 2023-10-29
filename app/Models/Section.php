<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends AbstractModelSaveProcess
{
    use HasFactory;

    public function fillFromForm(array $data, string $id)
    {
        $this->title   = $data['title'];
        $this->content = $data['content'];
    }

    public static function byRider(Rider $rider)
    {
        return self::where('rider_id', '=', $rider->id)->get();
    }

    public function rider(): BelongsTo
    {
        return $this->belongsTo(Rider::class);
    }
}
