<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $fillable = [
        'sch_id',
        'user_id',
        'status',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'sch_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}