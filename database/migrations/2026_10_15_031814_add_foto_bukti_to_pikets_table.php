<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pikets', function (Blueprint $table) {
            $table->string('foto_bukti')->nullable()->after('is_selesai');
        });
    }

    public function down(): void
    {
        Schema::table('pikets', function (Blueprint $table) {
            $table->dropColumn('foto_bukti');
        });
    }
};