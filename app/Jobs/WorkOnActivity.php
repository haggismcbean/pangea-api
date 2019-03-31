<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

// use App\Character;
// use App\Events\MessageSent;
use App\GameEvents\WorkOnActivityEvent;

class WorkOnActivity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;
    public $character;
    public $activity;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($character, $activity)
    {
        $this->character = $character;
        $this->activity = $activity;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->activity->progress = $this->activity->progress + 1;
        $this->activity->save();
        
        $workOnActivityEvent = new WorkOnActivityEvent();
        $workOnActivityEvent->handle($this->character, $this->activity);

        return true;
    }

    public function failed(Exception $exception) {
    }
}
