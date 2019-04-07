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
            $this->activity->progress = $this->activity->progress + 1;
            $this->activity->save();

            // recursion baby
            $workOnActivityEvent = new WorkOnActivityEvent($this->character, $this->activity);
            $workOnActivityEvent->handle($this->character, $this->activity);

            $job = new WorkOnActivity($this->character, $this->activity);
            $job->dispatch($this->character, $this->activity)
                ->delay(now()->addSeconds(1));
        } else {
            $itemType = $this->activity->recipe()->first()->item()->first();
            $item = ItemController::getItem('made_item', $itemType->id);

            if ($this->character->hasInventorySpace()) {
                $itemOwner = $this->getItemOwner('character', $this->character, $item);
            } else {
                $zone = $this->character->zone()->first();
                $itemOwner = $this->getItemOwner('zone', $zone, $item);
            }

            $itemOwner->count = $itemOwner->count + 1;
            $itemOwner->save();

            $this->activity->destroy($this->activity->id);
            $this->character->activity_id = null;

            // send item created message
            $workOnActivityEvent = new WorkOnActivityEvent();
            $workOnActivityEvent->handle($this->character, $this->activity);
        }

        return true;
    }

    private function getItemOwner($type, $owner, $item) {
        $itemOwners = $owner->itemOwners()->get();
        $itemOwner = null;

        foreach ($itemOwners as $currentItemOwner) {
            if ($currentItemOwner->item()->first()->name == $item->name) {
                $itemOwner = $currentItemOwner;
            }
        }

        if (!$itemOwner) {
            return ItemOwnerController::createNewItemOwner($type, $owner, $item);
        } else {
            return $itemOwner;
        }
    }

    public function failed(Exception $exception) {
    }
}
