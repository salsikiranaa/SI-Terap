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
        Schema::create('m_kecamatan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kabupaten_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('kabupaten_id')->references('id')->on('m_kabupaten');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_kecamatan');
    }
};
