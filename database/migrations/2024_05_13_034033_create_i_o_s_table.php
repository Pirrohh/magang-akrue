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
    Schema::create('i_o_s', function (Blueprint $table) {
        $table->id();
        $table->string('kode');
        $table->string('nomor_inet')->nullable();
        $table->string('billing_inet');
        $table->string('nomor_pots')->nullable();
        $table->string('billing_pots')->nullable();
        $table->string('periode_billing');
        $table->string('total_billing')->nullable();
        $table->string('revenue_share_inet')->nullable();
        $table->string('revenue_share_pots')->nullable();
        $table->string('total_billing_sharing')->nullable();
        $table->string('total_nilai_sharing')->nullable();
        $table->timestamps();

        $table->foreign('periode_billing')->references('periode_billing')->on('mitras')->onDelete('cascade');
        $table->foreign('kode')->references('kode')->on('billings')->onDelete('cascade');
        $table->foreign('nomor_inet')->references('nomor_inet')->on('pelanggans')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_o_s');
    }
};
