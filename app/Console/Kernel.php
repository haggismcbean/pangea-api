<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\HungerTime',
        'App\Console\Commands\GrowingTime',
        'App\Console\Commands\TimeChange',
        'App\Console\Commands\WeatherChange',
        'App\Console\Commands\ConditionsChange',
        'App\Console\Commands\ResetGatheredCounters',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('character:hunger-time')
                 ->hourly();

        $schedule->command('location:reset-gathered-counters')
                 ->hourly();

        $schedule->command('farm:growing-time')
                 ->daily();

        $schedule->command('zone:time-change')
                 ->everyFifteenMinutes();

        // every fifteen minutes 5 past the hour
        $schedule->command('zone:weather-change')
                 ->cron('5-59/15 * * * *');

        // every fifteen minutes 10 past the hour
        $schedule->command('character:conditions-change')
                 ->cron('10-59/15 * * * *');


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
