<?php

namespace App\Http\Controllers;

use App\ItemOwner;

class ItemOwnerController extends Controller
{
    public static function getItemOwner($type, $owner, $item) {
        $itemOwners = $owner->itemOwners()->get();
        $itemOwner = null;

        foreach ($itemOwners as $currentItemOwner) {
            $currentItem = $currentItemOwner->item()->first();


            if ($currentItem->id == $item->id && $currentItem->name == $item->name && $currentItem->type == $item->type) {
                $itemOwner = $currentItemOwner;
            }
        }

        if (!$itemOwner) {
            return ItemOwnerController::createNewItemOwner($type, $owner, $item);
        } else {
            return $itemOwner;
        }
    }

    public static function createNewItemOwner($type, $owner, $item, $count=1) {
        $itemOwner = new ItemOwner;

        $itemOwner->owner_type = $type;
        $itemOwner->owner_id = $owner->id;
        $itemOwner->item_id = $item->id;
        $itemOwner->count = $count;
        $itemOwner->age = 0;
        $itemOwner->quality = 0;

        $itemOwner->save();

        return $itemOwner;
    }

    public static function moveItemFromTo($from, $to, $toString, $itemId, $itemQuantity) {
        $fromItem = $from->itemOwners()->where('item_id', $itemId)->first();
        $toItem = $to->itemOwners()->where('item_id', $itemId)->first();

        $item = $fromItem->item()->first();

        if (!$item || !$fromItem) {
            return response()->json("Item could not be found", 400);
        }

        if ($fromItem->count < $itemQuantity) {
            return response()->json("Item quantity greater than count of items", 400);
        }

        $fromItem->count = $fromItem->count - $itemQuantity;
        $fromItem->save();

        if (!$toItem) {
            ItemOwnerController::createNewItemOwner($toString, $to, $item, $itemQuantity);
        } else {
            $toItem->count = $toItem->count + $itemQuantity;
            $toItem->save();
        }

        return response()->json($item, 200);
    }
}