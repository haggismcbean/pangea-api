<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WorldGenerator\AnimalGenerator;

class AnimalController extends Controller
{

    public function show() {
        $animal = new AnimalGenerator("deer");
        return response()->json($animal);
    }
}