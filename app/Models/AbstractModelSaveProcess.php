<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractModelSaveProcess extends Model
{
    public static function saveProcess(array $data, array $customAttributes = [])
    {
        $modelClass = get_called_class();

        if (empty($customAttributes)) {
            $items = $modelClass::all();
        } else {
            $items = $modelClass::where(key($customAttributes), '=', current($customAttributes))->get();
        }

        foreach ($items as $DBitem) {
            if (!isset($data[$DBitem->id])) {
                $DBitem->delete();
            }
        }

        foreach ($data as $id => $item) {
            if (substr($id, 0, 3) == 'new') {
                $DBitem = new $modelClass();
            } else {
                $DBitem = $items->filter(function($collectionItem) use ($id) {
                    return $collectionItem->id == $id;
                })->first();

                if ($DBitem === null) {
                    throw new \Exception('Item "'.$id.'" of class "'.$modelClass.'" not found.');
                }
            }

            foreach ($customAttributes as $index => $value) {
                $DBitem->$index = $value;
            }

            $DBitem->fillFromForm($item, $id);

            $DBitem->save();
        }
    }
}