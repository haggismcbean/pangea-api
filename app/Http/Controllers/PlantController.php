<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WorldGenerator\Plant;

class PlantController extends Controller
{

    public function show() {
        $plant = new Plant();
        return response()->json($plant);
    }
}