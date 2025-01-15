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
        Schema::create('aset_alat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ip2sip_id');
            $table->string('jenis_aset');
            $table->double('luas_lahan')->unsigned();
            $table->year('tahun_perolehan');
            $table->text('bukti_kepemilikan');
            $table->string('nomor_sertifikat');
            $table->string('pj_sertifikat');
            $table->timestamps();

            $table->foreign('ip2sip_id')->references('id')->on('m_ip2sip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_alat');
    }
};
