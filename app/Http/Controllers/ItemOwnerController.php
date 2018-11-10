<?php

namespace App\Http\Controllers;

use App\ItemOwner;

class ItemOwnerController extends Controller
{
    public static function createNewItemOwner($type, $owner, $item) {
        $itemOwner = new ItemOwner;

        $itemOwner->owner_type = $type;
        $itemOwner->owner_id = $owner->id;
        $itemOwner->item_id = $item->id;
        $itemOwner->count = 1;
        $itemOwner->age = 0;
        $itemOwner->quality = 0;

        $itemOwner->save();

        return $itemOwner;
    }
}