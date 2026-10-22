<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pikets', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']);
            $table->string('tugas'); // Contoh: Menyapu Lantai, Buang Sampah
            $table->boolean('is_selesai')->default(false); // Status checklist tugas
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pikets');
    }
};
