<?php

namespace App\Http\Controllers;

use App\Item;

class ItemController extends Controller
{
    public static function getItem($type, $typeId, $name) {
        return Item::where('item_type', $type)
            ->where('type_id', $typeId)
            ->where('name', $name)
            ->first();
    }

    public static function createNewItem($typeId, $name, $description) {
        $item = new Item;

        $item->item_type = 'plant';
        $item->type_id = $typeId;
        $item->unit_weight = 1;
        $item->unit_volume = 1;
        $item->rot_rate = 1;
        $item->name = $name;
        $item->description = $description;

        $item->save();

        return $item;
    }
}