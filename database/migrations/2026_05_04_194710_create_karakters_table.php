<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('karakters', function (Blueprint $table) {
            $table->id();
            $table->integer('difficulty'); // 1, 2, 3, atau 4
            $table->string('nama_karakter');
            $table->string('nama_anime');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karakters');
    }
};
