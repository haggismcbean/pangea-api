<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CharacterTraits;
use Carbon\Carbon;

class Traits extends Model
{
    public $trait;
    public $defaultLayout;

    private $traits = [];

    public function __construct($name, $defaultLayout=false)
    {
        $this->name = $name;
        $this->defaultLayout = $defaultLayout;
    }

    public function addTraitProperty($trait, $probabilityFunction)
    {
        $trait = (object) [
            'trait' => $trait,
            'probabilityFunction' => $probabilityFunction
        ];
        array_push($this->traits, $trait);
    }

    public function addTraitProperties($traits, $probabilityFunction)
    {
        foreach( $traits as $trait ) {
            $trait = (object) [
                'trait' => $trait,
                'probabilityFunction' => $probabilityFunction
            ];
            array_push($this->traits, $trait);
        }
    }

    public function getRandomTrait($argumentObject)
    {
        $totalProbability = 0;

        foreach( $this->traits as $trait ) {
            $trait->probability = call_user_func($trait->probabilityFunction, $argumentObject);
            $totalProbability += $trait->probability;
        }

        $traitIndex = rand(0, $totalProbability);
        $currentProbability = 0;

        foreach( $this->traits as $trait ) {
            $currentProbability += $trait->probability;

            if ($currentProbability >= $traitIndex) {
                $this->trait = $trait->trait;
                return $this;
            }
        }

        return false;
    }
}
