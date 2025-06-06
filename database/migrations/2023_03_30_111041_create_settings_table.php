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
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->time('mulai_masuk_siswa')->nullable();
            $table->time('jam_masuk_siswa')->nullable();
            $table->time('jam_pulang_siswa')->nullable();
            $table->time('batas_pulang_siswa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
