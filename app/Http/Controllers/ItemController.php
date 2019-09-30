<?php

namespace App\Http\Controllers;

use App\Item;

class ItemController extends Controller
{
    public static function getItem($type, $typeId, $name = null) {

        if ($name == null) {
            return Item::where('item_type', $type)
                ->where('type_id', $typeId)
                ->first();
        } else {
            return Item::where('item_type', $type)
                ->where('type_id', $typeId)
                ->where('name', strtolower($name))
                ->first();
        }
    }

    public static function createNewItem($typeId, $name, $description, $itemType, $efficiency = null) {
        $item = new Item;

        $item->item_type = $itemType;
        $item->type_id = $typeId;
        $item->name = $name;
        $item->description = $description;

        // TODO - fix the below :P
        if ($name === 'wood') {
            $item->unit_weight = rand(31, 57);
            $item->unit_volume = rand(8, 12);
            $item->efficiency = rand(8, 12);
            $item->rot_rate = 2;
        } else {
            // leaf, fruit, seed
            $item->unit_weight = $item->yield_per_item;
            $item->unit_volume = rand(8, 12);

            //efficiency for plants needs to be set to their yield gain when eaten.
            //which is then multiplied by the yield->hunger converter to work out
            //their hunger gain...
            if ($efficiency) {
                $item->efficiency = $efficiency;
            } else {
                $item->efficiency = 1;
            }

            $item->rot_rate = 1;
        }

        $item->save();

        return $item;
    }
}