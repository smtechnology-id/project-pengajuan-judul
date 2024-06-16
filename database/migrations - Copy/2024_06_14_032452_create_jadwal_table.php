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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_id');
            $table->unsignedBigInteger('penguji_satu');
            $table->unsignedBigInteger('penguji_dua');
            $table->unsignedBigInteger('penguji_tiga');
            $table->dateTime('waktu');
            $table->string('ruangan');
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraints
            $table->foreign('pengajuan_id')->references('id')->on('pengajuan')->onDelete('cascade');
            $table->foreign('penguji_satu')->references('id')->on('dosens')->onDelete('cascade');
            $table->foreign('penguji_dua')->references('id')->on('dosens')->onDelete('cascade');
            $table->foreign('penguji_tiga')->references('id')->on('dosens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
