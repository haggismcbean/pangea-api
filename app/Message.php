<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Character;

class Message extends Model
{
    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['message', 'source_name', 'source_id', 'source_type'];

    /**
     * A message belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function character()
    {
      return $this->belongsTo(Character::class);
    }
}
