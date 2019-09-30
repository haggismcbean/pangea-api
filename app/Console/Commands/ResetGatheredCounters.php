<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetGatheredCounters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:reset-gathered-counters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the resources gathered counters';

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
        $locations = Location::where('biome', '!=', 'Ocean')->get();
        $day = Clock::getDayOfYear();

        foreach ($locations as $location) {
            if (!Clock::isMidnight($location)) {
                return;
            }
            $location->animals_gathered_today = 0;
            $location->save();

            $locationPlants = $location->locationPlants();

            foreach($locationPlants as $locationPlant) {
                $locationPlant->fruit_gathered_today = 0;
                $locationPlant->flower_gathered_today = 0;
                $locationPlant->seed_gathered_today = 0;
                $locationPlant->leaf_gathered_today = 0;
                $locationPlant->stalk_gathered_today = 0;
                $locationPlant->root_gathered_today = 0;
                $locationPlant->save();
            }
        }
    }
}
