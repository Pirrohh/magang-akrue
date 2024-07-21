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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('nomor_inet');
            $table->string('billing_inet')->nullable();
            $table->string('nomor_pots')->nullable();
            $table->string('periode_billing')->nullable();
            $table->string('total_billing')->nullable();
            $table->string('tanggal_bayar')->nullable();
            $table->timestamps();

            $table->index('kode');
            $table->foreign('periode_billing')->references('periode_billing')->on('mitras')->onDelete('cascade');
            $table->foreign('nomor_inet')->references('nomor_inet')->on('pelanggans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
