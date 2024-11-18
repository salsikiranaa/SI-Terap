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
        // Schema::table('m_provinsi', function (Blueprint $table) {
        //     $table->decimal('latitude', 10, 8)->nullable()->after('name');  // Sesuaikan dengan kolom 'name'
        //     $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
        //     $table->integer('jumlah_dokumen')->default(0)->after('longitude');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('m_provinsi', function (Blueprint $table) {
        //     $table->dropColumn(['latitude', 'longitude', 'jumlah_dokumen']);
        // });
    }
};
