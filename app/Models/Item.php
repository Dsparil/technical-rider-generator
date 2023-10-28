<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Item extends AbstractModelSaveProcess
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

    public function fillFromForm(array $data, string $id)
    {
        $this->name      = $data['name'];
        $this->item_type = $data['item_type'];

        /** @var UploadedFile $imageObject */
        $imageObject = request()->file('items')[$id]['picture'] ?? null;

        $this->save();

        if ($imageObject !== null) {
            $fileName = 'item_'.$this->id.'.'.$imageObject->clientExtension();

            $imageObject->storePubliclyAs('public/items', $fileName);

            $this->picture = asset('storage/items/'.$fileName);
        }
    }

    public static function enumValues()
    {
        return [
            self::TYPE_INSTRUMENT => 'Instruments',
            self::TYPE_AMP        => 'Amplis / Têtes',
            self::TYPE_CAB        => 'Cabs',
            self::TYPE_PLUG       => 'Prises',
            self::TYPE_OTHER      => 'Accessoires / Autres',
        ];
    }

    public static function getAllOrdered()
    {
        return self::orderBy('item_type', 'asc')->orderBy('name', 'asc')->get();
    }

    public function isType(string $type): bool
    {
        return $this->item_type == $type;
    }
}
