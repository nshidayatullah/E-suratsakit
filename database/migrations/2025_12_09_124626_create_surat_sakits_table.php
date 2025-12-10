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
        Schema::create('surat_sakits', function (Blueprint $table) {
            $table->id();
            $table->integer('no')->nullable();
            $table->string('nrp', 20)->index();
            $table->string('nama');
            $table->integer('umur')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('departemen', 50)->nullable()->index();
            $table->text('keluhan')->nullable();
            $table->string('jam_keluar_surat', 10)->nullable();
            $table->date('tanggal_surat')->nullable()->index();
            $table->string('ttd_petugas', 20)->nullable();
            $table->string('petugas', 100)->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_sakits');
    }
};
