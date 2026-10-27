<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // Tambahkan ini agar kolom bisa diisi lewat Controller
    protected $fillable = [
        'user_id',
        'eventName',
        'eventDate',
        'eventTime',
        'eventLocation',
        'eventDesc',
    ];

    // Relasi ke User (Siapa yang buat jadwal)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}