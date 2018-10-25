<?php

namespace App\WorldGenerator;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;


class BiomeGenerator extends Model
{
    public function __construct($name, $rainfall, $temperature)
    {
        $this->name = $name;
        $this->rainfall = $rainfall;
        $this->temperature = $temperature;
        $this->setSeasonConditions($this->rainfall, $this->temperature);
    }

    public function setSeasonConditions($averageRainfall, $averageTemperature) {
        $this->sproutRainfall = $averageRainfall + $this->getSeasonVariation($averageRainfall);
        $this->sproutTemperature = $averageTemperature + $this->getSeasonVariation($averageTemperature);

        $this->deathRainfall = $averageRainfall - $this->getSeasonVariation($averageRainfall);
        $this->deathTemperature = $averageTemperature - $this->getSeasonVariation($averageTemperature);

        $this->plantDensity = $this->getPlantDensity($averageRainfall, $averageTemperature);
    }

    private function getSeasonVariation($averageValue) {
        switch ($averageValue) {
            case 0:
            case 1:
                return 3;
            
            case 2: 
            case 3: 
                return 2;

            case 4: 
            case 5:
                return 1;

            default:
                return 0;
        }
    }

    private function getPlantDensity($averageRainfall, $averageTemperature) {
        switch ($averageTemperature) {
            case 0: //Polar
                return 0;
            
            case 1: //Subpolar
                return $averageRainfall > 0 ? 1 : 0;

            case 2: //Boreal
                return $averageRainfall > 2 ? 2 : 1;

            case 3: //Cool Temperate
                if ($averageRainfall < 2) {
                    return 3;
                }

                if ($averageRainfall < 4) {
                    return 4;
                }

                return 5;

            case 4: //Warm Temperate
                if ($averageRainfall < 2) {
                    return 4;
                }

                if ($averageRainfall < 4) {
                    return 5;
                }

                if ($averageRainfall < 6) {
                    return 6;
                }

                return 7;

            case 5: //Subtropical
                if ($averageRainfall < 2) {
                    return 4;
                }

                if ($averageRainfall < 4) {
                    return 6;
                }

                if ($averageRainfall < 6) {
                    return 7;
                }

                return 9;

            default:

            case 6: //Tropical
                if ($averageRainfall < 2) {
                    return 3;
                }

                if ($averageRainfall < 4) {
                    return 6;
                }

                if ($averageRainfall < 6) {
                    return 8;
                }

                return 10;
        }
    }
}
