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
    Schema::create('mitras', function (Blueprint $table) {
        $table->id();
        $table->string('kode')->nullable();
        $table->string('nama_mitra')->nullable();
        $table->string('nama_lop')->nullable();
        $table->string('periode_billing')->nullable();
        $table->string('bulan_awal_sharing')->nullable();
        $table->string('bulan_akhir_sharing')->nullable();
        $table->string('sharing(%)')->nullable();
        $table->timestamps();

        $table->index('periode_billing');
        $table->index('nama_mitra'); // Menambahkan indeks pada kolom 'nama_mitra' dan 'periode_billing'
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitras');
    }
};
