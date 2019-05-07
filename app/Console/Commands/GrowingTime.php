<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Farm;
use App\Message;
use App\Events\MessageSent;

use App\World\Clock;

class GrowingTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farm:growing-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculates yield changes for every farm';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $farms = Farm::get();

        foreach( $farms as $farm ) {
            if (!$this->isFarmGrowing($farm)) {
                return;
            }

            $plant = $farm->plant()->first();
            $location = $farm->zone()->first()->location()->first();

            $temperature = Clock::getTemperature();
            $rainfall = Clock::getRainfall();

            if ($this->isCorrectTemperature($temperature, $plant) && $this->isCorrectRainfall($rainfall, $plant)) {
                // crops can't take more than a year to mature.
                // TODO - I want yields to go in a curve, from low to high, then from high to low, then back.
                // TODO - crops should fail some years. This is very important.
                if ($farm->yield == 40) {
                    return;
                }

                // ideal growing conditions!
                $farm->yield = $farm->yield + 1;
            } else {
                if ($farm->yield == 0) {
                    return;
                }

                $farm->yield = $farm->yield - 1;
            }
        }
    }

    public function isFarmGrowing($farm) {
        if (!$farm->was_planted_at) {
            return false;
        }

        if (!$farm->plant()->first()) {
            return false;
        }

        return true;
    }

    public function isCorrectTemperature($temperature, $plant) {
        return $temperature > $plant->temperatureMin && $temperature < $plant->temperatureMax;
    }

    public function isCorrectRainfall($rainfall, $plant) {
        return $rainfall > $plant->rainfallMin && $rainfall < $plant->rainfallMax;
    }
}
