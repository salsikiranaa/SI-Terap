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
        Schema::create('pendampingan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bsip_id')->unsigned(); //
            $table->date('tanggal');
            $table->string('nama_lembaga');
            $table->bigInteger('lembaga_id')->unsigned(); //
            $table->integer('skala')->unsigned();
            $table->enum('unit_skala', ['ton', 'ha', 'unit']);
            $table->string('lpk');
            $table->bigInteger('jenis_standard_id')->unsigned(); //
            $table->bigInteger('kelompok_standard_id')->unsigned(); //
            $table->string('nomor_standard');
            $table->string('judul_standard');
            $table->enum('capaian_kegiatan', ['belum dapat sertifikat', 'sertifikat bina UMKM', 'sertifikat SNI']);
            $table->bigInteger('created_by')->unsigned(); //
            $table->bigInteger('updated_by')->unsigned(); //
            $table->timestamps();

            $table->foreign('bsip_id')->references('id')->on('m_bsip');
            $table->foreign('lembaga_id')->references('id')->on('m_lembaga');
            $table->foreign('jenis_standard_id')->references('id')->on('m_jenis_standard');
            $table->foreign('kelompok_standard_id')->references('id')->on('m_kelompok_standard');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendampingan');
    }
};
