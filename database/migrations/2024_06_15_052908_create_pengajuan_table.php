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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('dosen_satu');
            $table->unsignedBigInteger('dosen_dua');
            $table->unsignedBigInteger('program_studi_id');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('status')->default('pending'); // Default status
            $table->text('catatan')->nullable();
            $table->text('jadwal')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dosen_satu')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreign('dosen_dua')->references('id')->on('dosen')->onDelete('cascade');
            $table->foreign('program_studi_id')->references('id')->on('program_studi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
