<?php

namespace App\Http\Controllers;

use App\Item;

class ItemController extends Controller
{
    public static function getItem($plantId) {
        return Item::where('item_type', 'plant')
            ->where('type_id', $plantId)
            ->where('name', 'leaf')
            ->first();
    }

    public static function createNewItem($plantId) {
        $item = new Item;

        $item->item_type = 'plant';
        $item->type_id = $plantId;
        $item->unit_weight = 1;
        $item->unit_volume = 1;
        $item->rot_rate = 1;
        $item->name = 'leaf';
        $item->description = 'A big leaf';

        $item->save();

        return $item;
    }
}