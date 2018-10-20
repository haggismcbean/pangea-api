<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WorldGenerator\World;

class WorldController extends Controller
{

    public function show() {
        $world = new World();
        return response()->json($world);
    }
}