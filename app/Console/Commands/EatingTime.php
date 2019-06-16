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
                $character->hunger = $character->hunger - 1;
                $character->save();

                $message = $character->messages()->create([
                    'message' => 'You are hungry',
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

                if ($character->hunger < 100) {
                    $character->hunger = $character->hunger + 1;
                    $character->save();
                }

                $message = $character->messages()->create([
                    'message' => 'You take a moment to eat ' . $food->name . ', and continue on your day',
                    'source_type' => 'system',
                    'source_name' => '',
                    'source_id' => 0,
                ]);

                broadcast(new MessageSent($character, $message));
            }
        }
    }
}
