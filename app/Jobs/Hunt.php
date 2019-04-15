<?php

namespace App\Jobs;

use App\Jobs\Job;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\GameEvents\HuntEvent;

class Hunt implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;
    public $character;
    public $itemUse;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($character, $itemUse)
    {
        $this->character = $character;
        $this->itemUse = $itemUse;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // roll for chances of success
        // TODO - skills
        $skillBoost = 0;
        $itemBoost = $itemUse->item()->first()->items()->first()->efficiency;

        $successChance = 0.01 * $skillBoost * $itemBoost;

        $roll = rand(0, 100);
        
        $huntEvent = new HuntEvent();

        if ($roll < $successChance) {
            $isSuccess = true;
        } else {
            $isSuccess = false;
        }
        
        $huntEvent->handle($this->character, $this->itemUse, $isSuccess);

        return true;
    }

    public function failed(Exception $exception) {
    }
}
