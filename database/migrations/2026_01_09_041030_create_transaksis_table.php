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
        Schema::create('Transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('user_id');
            $table->foreignId('buku_id');
            $table->integer('total_pinjam')->default(1);
            $table->integer('jumlah_dikembalikan')->default(0);
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->tinyInteger('status')->default(0)->comment('0=Pending,1=Sukses,2=Dikembalikan,3=Ditolak');
            $table->boolean('ajukan_pengembalian')->default(false);
            $table->integer('jumlah_pengajuan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Transaksi');
    }
};
