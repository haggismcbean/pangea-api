<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Character;
use App\Message;
use App\Events\MessageSent;

use App\World\Clock;
use App\Names\DeathFactory;

class HungerTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'character:hunger-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executes the hunger event';

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

            if (!Clock::isBreakfastHour($location) || Clock::isLunchHour($location) || Clock::isDinnerHour($location)) {
                return;
            }

            $character->hunger = $character->hunger - 20;
            $character->save();

            $message = $character->messages()->create([
                'message' => 'You are hungry',
                'source_type' => 'system',
                'source_name' => '',
                'source_id' => 0,
            ]);

            if ($character->hunger < 1) {
                $character->is_dead = true;
                $character->save();

                $message = DeathFactory::getHungerMessage($character);

                broadcast(new MessageSent($character, $message));
                $character->delete();
                return;
            }

            broadcast(new MessageSent($character, $message));
        }
    }
}
