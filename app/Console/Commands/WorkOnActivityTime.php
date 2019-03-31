<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Character;
use App\Message;
use App\Events\MessageSent;

use App\Time\Clock;

class WorkOnActivityTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'character:work-on-activity-time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executes the work on activity event';

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
            // first get the activity each character is working on
            $activity = $character->activity()->first();

            if ($activity) {
                // then execute it!
                // Okay so we basically just loop this each second or whatever with progress going up until
                // The user stops working on the activity.

                // TODO - validation on whether we can progress it!
                $activity->progress = $activity->progress + 1;
                $activity->save();

                if ($activity->progress == 100) {
                    // TODO - put the item somewhere and delete the activity!
                }

                $message = $character->messages()->create([
                    'message' => 'You worked on activity ' . $activity->id,
                    'source_type' => 'character',
                    'source_name' => $character->name,
                    'source_id' => $character->id,
                ]);
                broadcast(new MessageSent($character, $message));
            }
        }
    }
}
