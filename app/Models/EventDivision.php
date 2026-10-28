<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventDivision extends Model
{
    protected $fillable = ['event_id', 'name'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}