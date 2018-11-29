<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;


class Task extends Model
{
    public function taskInputs()
    {
      return $this->hasMany(TaskInput::class);
    }

    public function taskOutputs()
    {
      return $this->hasMany(TaskOutput::class);
    }    
}
