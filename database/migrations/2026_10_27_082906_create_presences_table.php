<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel jadwal
            $table->foreignId('sch_id')->constrained('schedules')->onDelete('cascade');
            // Menghubungkan ke user (anggota yang diabsen)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Status kehadiran (hadir, izin, alfa)
            $table->enum('status', ['present', 'leave', 'alfa'])->default('alfa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
