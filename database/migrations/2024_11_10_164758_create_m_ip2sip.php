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
        Schema::create('m_ip2sip', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bsip_id')->unsigned();
            $table->string('name')->unique();
            $table->double('luas_lahan')->unsigned();
            $table->timestamps();

            $table->foreign('bsip_id')->references('id')->on('m_bsip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_ip2sip');
    }
};
