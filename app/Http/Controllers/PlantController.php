<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemOwnerController;

class PlantController extends Controller
{
    public function show() {
        $animal = new Animal();
        return response()->json($world);
    }
}