<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cetak_surat_sakits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_sakit_id')->constrained('surat_sakits')->onDelete('cascade');
            $table->string('short_code', 10)->unique();
            $table->string('nama');
            $table->integer('umur')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('departemen')->nullable();
            $table->text('keluhan')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('jam_keluar_surat', 10)->nullable();
            $table->string('petugas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cetak_surat_sakits');
    }
};
