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
        Schema::create('biodata_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('program_studi_id');
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('no_hp');
            $table->timestamps();

            // Definisi foreign key untuk user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Definisi foreign key untuk program_studi_id
            $table->foreign('program_studi_id')->references('id')->on('program_studi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata_mahasiswa');
    }
};
