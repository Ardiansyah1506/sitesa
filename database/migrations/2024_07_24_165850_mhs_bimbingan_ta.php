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
        Schema::create('mhs_bimbingan_ta', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->char('status', 1); // D/B
            $table->integer('ta_1')->default(0);
            $table->integer('ta_2')->default(0);
            $table->string('email');
            $table->bigInteger('no_hp');
            $table->string('nip');
            $table->string('nama_pembimbing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mhs_bimbingan_ta');
    }
};
