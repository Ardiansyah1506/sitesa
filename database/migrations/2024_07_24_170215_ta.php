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
        Schema::create('ta', function (Blueprint $table) {
            $table->id();
            $table->integer('kode_ta');
            $table->string('nim');
            $table->string('nama_file');
            $table->string('tanggal');
            $table->integer('status')->default(0);
            $table->string('nota_pembimbing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ta');
    }
};
