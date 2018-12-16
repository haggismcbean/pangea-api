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
    public $character;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($character)
    {
        $this->character = $character;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //todo: actually implement the attack. random roll on how much damage it does.
        $message = "test";
        $this->character->health = 99;
        $this->character->save();
        $attackCharacterEvent = new AttackCharacterEvent();
        $attackCharacterEvent->handle($this->character);
        return true;

    }

    public function failed(Exception $exception) {
        // $attackCharacterEvent = new AttackCharacterEvent();
        // $attackCharacterEvent->handle($attacker);
    }
}
