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
        Schema::create('kaprodi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('program_studi_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('nip');
            $table->string('jabatan');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('program_studi_id')->references('id')->on('program_studi')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaprodi');
    }
};
