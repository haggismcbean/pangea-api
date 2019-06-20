<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Character;
use App\Message;
use App\Events\MessageSent;

use App\Names\ExposureFactory;
use App\World\Clock;

class ConditionsChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'character:conditions-change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executes the exposure/uncomfortable event';

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
        $characters = Character::get();

        foreach( $characters as $character ) {

            $location = $character->location()->first();

            if (!$location) {
                return;
            }

            $exposure = $character->exposure;
            $temperature = Clock::getTemperature($location);

            if ($temperature < 3) {
                // TODO - clothing and being inside
                $character->exposure = $character->exposure - $this->getExposureChange($temperature);
                $character->save();

                $exposureMessage = ExposureFactory::getMessage($exposure);

                $message = $character->messages()->create([
                    'message' => $exposureMessage,
                    'source_type' => 'system',
                    'source_name' => '',
                    'source_id' => 0,
                ]);

                broadcast(new MessageSent($character, $message));
            }
        }
    }

    private function getExposureChange($temperature) {
        if ($temperature === 0) {
            return 30;
        }

        if ($temperature === 1) {
            return 20;
        }

        if ($temperature === 2) {
            return 10;
        }
    }
}
