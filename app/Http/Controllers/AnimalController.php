<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WorldGenerator\AnimalGenerator;

use App\Animal;

class AnimalController extends Controller
{

    public function show() {
        $animal = new AnimalGenerator("fish");
        return response()->json($animal);
    }

    public static function getDeadAnimal($biome, $name) {
    	// TODO! - use seasons to find if animal is here!

    	return Animal::where('name', $name)->first();
    }
}