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
        Schema::create('siswas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('nis');
            $table->string('nama');
            $table->tinyInteger('gender');
            $table->uuid('rfid_id')->nullable();
            $table->uuid('kelas_id');
            $table->string('telepon_wali');

            $table->foreign('rfid_id')->references('id')->on('rfids')->onDelete('set null');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};