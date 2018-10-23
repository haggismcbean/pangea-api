<?php

namespace App\Traits\BiomeTypes;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Biome
{
    public function getRandomType($types) {
        $totalProbability = 0;

        foreach( $types as $type ) {
            $totalProbability += $type->probability;
        }

        $typeIndex = rand(0, $totalProbability);
        $currentProbability = 0;

        foreach( $types as $type ) {
            $currentProbability += $type->probability;

            if ($currentProbability >= $typeIndex && $type->probability > 0) {
                return $type;
            }
        }

        return false;
    }
}
