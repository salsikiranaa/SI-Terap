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
        Schema::create('perbenihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kabupaten_id');
            $table->unsignedBigInteger('komoditas_id');
            $table->unsignedBigInteger('kelas_benih_id');
            $table->enum('bulan', [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember',
            ]);
            $table->year('tahun');
            $table->timestamps();
            
            $table->foreign('kabupaten_id')->references('id')->on('m_kabupaten');
            $table->foreign('komoditas_id')->references('id')->on('m_komoditas');
            $table->foreign('kelas_benih_id')->references('id')->on('m_kelas_benih');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbenihan');
    }
};
