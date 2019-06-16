<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Character;
use App\Message;
use App\Events\MessageSent;

use App\World\Clock;

class EatingTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'character:eating-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executes the eating/hunger event';

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
            // if it is not morning for this character, then he shouldnt eat breakfast
            $location = $character->location()->first();
            if (!Clock::isBreakfastHour($location) || Clock::isLunchHour($location) || Clock::isDinnerHour($location)) {
                return;
            }

            $food = $character->items()
                ->where('item_type', 'made_food')
                ->first();

            if (!$food) {
                $character->hunger = $character->hunger - 20;
                $character->save();

                $message = $character->messages()->create([
                    'message' => 'After another restless night you realise you wake up ravenous. Then you remember you have no food. You want to go back to sleep but you\'re too hungry, so you get up and begin the day.',
                    'source_type' => 'system',
                    'source_name' => '',
                    'source_id' => 0,
                ]);

                broadcast(new MessageSent($character, $message));
            } else {
                $foodStock = $food->owners()
                    ->where('owner_type', 'character')
                    ->where('owner_id', $character->id)
                    ->first();

                $foodStock->count = $foodStock->count - 1;
                $foodStock->save();

                $message = $character->messages()->create([
                    'message' => 'You wake up cold. Dread fills your stomach as the prospect of another day greets you. But at least today you won\'t go hungry. You eat ' . $food->name . 'and set about your day.',
                    'source_type' => 'system',
                    'source_name' => '',
                    'source_id' => 0,
                ]);

                broadcast(new MessageSent($character, $message));
            }
        }
    }
}
