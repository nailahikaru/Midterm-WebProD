<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description', 'location',
        'start_date', 'end_date', 'registration_deadline', 'quota',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'registration_deadline' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function divisions()
    {
        return $this->hasMany(EventDivision::class);
    }

    public function seatsTaken()
    {
        return $this->registrations()->where('status', '!=', 'ditolak')->count();
    }

    public function seatsLeft()
    {
        return max(0, $this->quota - $this->seatsTaken());
    }

    public function isRegistrationOpen()
    {
        return now()->toDateString() <= $this->registration_deadline->toDateString();
    }
}