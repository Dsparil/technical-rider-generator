<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
