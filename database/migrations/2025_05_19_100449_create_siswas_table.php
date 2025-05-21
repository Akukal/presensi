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
            $table->enum('gender', ['pria', 'wanita'])->default('pria');
            $table->string('code')->nullable();
            $table->uuid('tahun_id');
            $table->uuid('kelas_id');
            $table->uuid('guru_id');

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('tahun_id')->references('id')->on('tahun_ajarans')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
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