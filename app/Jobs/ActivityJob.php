<?php

namespace App\Jobs;

use App\Jobs\Job;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Http\Controllers\ActivityController;

class ActivityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    public $activityController;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($activityController)
    {
        $this->activityController = $activityController;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->activityController->workOnActivity();

        return true;
    }

    public function failed(Exception $exception) {
    }
}
