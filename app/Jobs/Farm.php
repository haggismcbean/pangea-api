<?php

namespace App\Jobs;

use App\Jobs\Job;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\GameEvents\HuntEvent;
use App\Http\Controllers\FarmController;

class Farm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;
    public $character;
    public $itemBoost;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($character, $itemBoost, $plant)
    {
        $this->character = $character;
        $this->itemBoost = $itemBoost;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        FarmController::farm($this->character, $this->itemBoost, $this->plant);

        return true;
    }

    public function failed(Exception $exception) {
    }
}
