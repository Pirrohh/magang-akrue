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
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id(); // Buat primary key incrementing
            $table->string('kode')->nullable();
            $table->string('nama_mitra')->nullable();
            $table->string('nama_lop')->nullable();
            $table->string('nomor_inet')->nullable();
            $table->string('nomor_pots')->nullable();
            $table->string('nama_pelanggan')->nullable();
            $table->string('tanggal_aktivasi')->nullable(); // Tipe data untuk tanggal
            $table->timestamps();
            
            $table->index('nomor_inet');
            $table->foreign('nama_mitra')->references('nama_mitra')->on('mitras')->onDelete('cascade');
        });
    }


    

    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
