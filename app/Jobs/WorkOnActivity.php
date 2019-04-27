<?php

namespace App\Jobs;

use App\Jobs\Job;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

// use App\Character;
// use App\Events\MessageSent;
use App\GameEvents\WorkOnActivityEvent;

use App\Http\Controllers\CraftingController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemOwnerController;

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
        if ($this->character->activity_id != $this->activity->id) {
            return false;
        }

        if ($this->activity->progress < 99 && $this->activity->isReadyForWork()) {
            CraftingController::workActivity($this->character, $this->activity);
        } else {
            CraftingController::completeActivity($this->character, $this->activity);
        }

        return true;
    }

    public function failed(Exception $exception) {
    }
}
