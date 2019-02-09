<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\WorldGenerator\AnimalGenerator;

use App\Time\Clock;

class AnimalController extends Controller
{

    public function show() {
        // $animal = new AnimalGenerator("fish");

        $dayOfYear = Clock::getDayOfYear();
        return response()->json($dayOfYear);
    }
}