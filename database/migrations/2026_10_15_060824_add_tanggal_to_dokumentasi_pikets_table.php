<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('dokumentasi_pikets', function (Blueprint $table) {
            // Drop unique hari jika sebelumnya ada, agar bisa menyimpan riwayat foto tiap minggu/tanggal
            $table->dropUnique(['hari']);
            $table->date('tanggal')->nullable()->after('hari');
        });
    }

    public function down(): void
    {
        Schema::table('dokumentasi_pikets', function (Blueprint $table) {
            $table->dropColumn('tanggal');
            $table->unique('hari');
        });
    }
};