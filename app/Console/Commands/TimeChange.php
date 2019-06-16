<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Character;
use App\Message;
use App\Events\MessageSent;

use App\Names\TimeFactory;
use App\World\Clock;

class TimeChange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zone:time-change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Informs online users of current daylight conditions';

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

            $time = Clock::getLocationTimezone($location);

            $timeMessage = TimeFactory::getDaylightMessage($time);

            $message = $character->messages()->create([
                'message' => $timeMessage,
                'source_type' => 'system',
                'source_name' => '',
                'source_id' => 0,
            ]);

            broadcast(new MessageSent($character, $message));
        }
    }
}
