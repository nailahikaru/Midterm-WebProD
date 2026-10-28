<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    public const DIVISIONS = [
        'Acara', 'Humas', 'Dokumentasi', 'Perlengkapan', 'Konsumsi', 'Desain',
    ];

    protected $fillable = [
        'event_id', 'user_id', 'name', 'nrp', 'division', 'reason', 'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}