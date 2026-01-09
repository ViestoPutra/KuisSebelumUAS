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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            
            // TODO: Tambahkan kolom-kolom sesuai requirements:
            $table->foreignId('kontrak_sewa_id')->constrained('kontrak_sewa')->onDelete('cascade');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->date('tanggal_bayar');
            $table->enum('status', ['lunas', 'tertunggak'])->default('tertunggak');
            $table->text('keterangan')->nullable();
            
            // TODO BONUS: Jika mengerjakan fitur bonus upload bukti transfer
            // - bukti_transfer: string()->nullable() (path file image)
            $table->string('bukti_transfer')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
