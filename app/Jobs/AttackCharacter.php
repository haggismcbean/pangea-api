<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

// use App\Character;
// use App\Events\MessageSent;
use App\GameEvents\AttackCharacterEvent;

class AttackCharacter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;
    public $attacker;
    public $defender;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($attacker, $defender)
    {
        $this->attacker = $attacker;
        $this->defender = $defender;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // to do: items etc.
        $this->defender->health = $this->defender->health - 20;
        $this->defender->save();
        
        $attackCharacterEvent = new AttackCharacterEvent();
        $attackCharacterEvent->handle($this->attacker, $this->defender);

        return true;
    }

    public function failed(Exception $exception) {
    }
}
