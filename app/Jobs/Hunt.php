<?php

namespace App\Jobs;

use App\Jobs\Job;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\GameEvents\HuntEvent;
use App\Http\Controllers\HuntController;

class Hunt implements ShouldQueue
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
    public function __construct($character, $itemBoost)
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

        HuntController::hunt($this->character, $this->itemBoost);

        return true;
    }

    public function failed(Exception $exception) {
    }
}
