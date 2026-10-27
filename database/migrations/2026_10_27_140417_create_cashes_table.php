<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cashes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Siapa yang input
            $table->enum('type', ['income', 'expense']); // Pemasukan / Pengeluaran
            $table->integer('amount'); // Nominal uang
            $table->string('description'); // Keterangan
            $table->date('date'); // Tanggal transaksi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cashes');
    }
};