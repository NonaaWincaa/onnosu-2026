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
    Schema::create('tiket_orders', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('email')->nullable(); // <-- TAMBAHKAN BARIS INI
        $table->string('jurusan');
        $table->string('asal_univ');
        $table->integer('jumlah_tiket');
        $table->string('batch_pembelian');
        $table->integer('harga_per_tiket');
        $table->integer('diskon')->default(0);
        $table->integer('total_bayar');
        $table->string('bukti_pembayaran');
        $table->string('status_pembayaran')->default('Pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket_orders');
    }
};
