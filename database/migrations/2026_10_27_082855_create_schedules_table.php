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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            // penghubung ke tabel user
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            
            $table->string('eventName');
            $table->date('eventDate');
            $table->time('eventTime');
            $table->string('eventLocation');
            $table->text('eventDesc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
