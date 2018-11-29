<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;


class TaskOutput extends Model
{
    public function task()
    {
      return $this->belongsTo(Task::class);
    }
}
