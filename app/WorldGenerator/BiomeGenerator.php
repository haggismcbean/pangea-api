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
        $this->highestRainfall = $averageRainfall + 1;
        $this->hottestTemperature = $averageTemperature + $this->getSeasonVariation($averageTemperature);

        $this->lowestRainfall = $averageRainfall - 1;
        $this->coldestTemperature = $averageTemperature - $this->getSeasonVariation($averageTemperature);

        $this->plantDensity = $this->getPlantDensity($averageRainfall, $averageTemperature);

        $this->averageHunterGathererYield = $this->getYield('hunter', $averageRainfall, $averageTemperature);
        $this->averagePastoralYield = $this->getYield('pastoral', $averageRainfall, $averageTemperature);
        $this->averageArableYield = $this->getYield('arable', $averageRainfall, $averageTemperature);
    }

    private function getSeasonVariation($averageValue) {
        switch ($averageValue) {
            case 0:
            case 1:
                return 1;
            
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

    private function getYield($type, $averageRainfall, $averageTemperature) {
        switch ($averageTemperature) {
            case 0:
                switch($type) {
                    case 'hunter': 
                        return 100;
                    case 'pastoral': 
                        return 0;
                    case 'arable':
                        return 0;
                }
            case 1:
                switch($type) {
                    case 'hunter': 
                        return 100;
                    case 'pastoral': 
                        return 600;
                    case 'arable':
                        return 0;
                }

            case 2:
                switch($averageRainfall) {
                    case 0:
                    case 1:
                        switch($type) {
                            case 'hunter': 
                                return 100;
                            case 'pastoral': 
                                return 600;
                            case 'arable':
                                return 0;
                        }
                    case 2:
                    case 3:
                    case 4:
                        switch($type) {
                            case 'hunter': 
                                return 300;
                            case 'pastoral': 
                                return 900;
                            case 'arable':
                                return 200;
                        }
                }

            case 3:
                switch($averageRainfall) {
                    case 0:
                    case 1:
                        switch($type) {
                            case 'hunter': 
                                return 100;
                            case 'pastoral': 
                                return 900;
                            case 'arable':
                                return 200;
                        }
                    case 2:
                        switch ($type) {
                            case 'hunter': 
                                return 100;
                            case 'pastoral': 
                                return 900;
                            case 'arable':
                                return 300;

                        }
                    case 3:
                    case 4:
                    case 5:
                        switch($type) {
                            case 'hunter': 
                                return 300;
                            case 'pastoral': 
                                return 900;
                            case 'arable':
                                return 5000;
                        }
                }

            case 4:
                switch($averageRainfall) {
                    case 0:
                    case 1:
                        switch($type) {
                            case 'hunter': 
                                return 100;
                            case 'pastoral': 
                                return 300;
                            case 'arable':
                                return 0;
                        }
                    case 2:
                    case 3:
                        switch ($type) {
                            case 'hunter': 
                                return 200;
                            case 'pastoral': 
                                return 1500;
                            case 'arable':
                                return 3500;

                        }
                    case 4:
                    case 5:
                    case 6:
                        switch($type) {
                            case 'hunter': 
                                return 200;
                            case 'pastoral': 
                                return 1500;
                            case 'arable':
                                return 5000;
                        }
                }

            case 5:
                switch($averageRainfall) {
                    case 0:
                    case 1:
                        switch($type) {
                            case 'hunter': 
                                return 100;
                            case 'pastoral': 
                                return 300;
                            case 'arable':
                                return 0;
                        }
                    case 2:
                        switch ($type) {
                            case 'hunter': 
                                return 300;
                            case 'pastoral': 
                                return 1200;
                            case 'arable':
                                return 700;

                        }
                    case 3:
                    case 4:
                        switch($type) {
                            case 'hunter': 
                                return 400;
                            case 'pastoral': 
                                return 600;
                            case 'arable':
                                return 3500;
                        }
                    case 5:
                    case 6:
                    case 7:
                        switch($type) {
                            case 'hunter': 
                                return 400;
                            case 'pastoral': 
                                return 600;
                            case 'arable':
                                return 1500;
                        }
                }

            case 6:
                switch($averageRainfall) {
                    case 0:
                    case 1:
                        switch($type) {
                            case 'hunter': 
                                return 100;
                            case 'pastoral': 
                                return 300;
                            case 'arable':
                                return 0;
                        }
                    case 2:
                    case 3:
                        switch ($type) {
                            case 'hunter': 
                                return 300;
                            case 'pastoral': 
                                return 1200;
                            case 'arable':
                                return 700;

                        }
                    case 4:
                        switch($type) {
                            case 'hunter': 
                                return 400;
                            case 'pastoral': 
                                return 600;
                            case 'arable':
                                return 3500;
                        }
                    case 5:
                    case 6:
                    case 7:
                        switch($type) {
                            case 'hunter': 
                                return 400;
                            case 'pastoral': 
                                return 600;
                            case 'arable':
                                return 1500;
                        }
                }
        }
    }
}
