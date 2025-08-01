<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemanfaatan_sip_dokumentasi', function (Blueprint $table) {
            $table->foreignId('pemanfaatan_sip_id')->constrained('pemanfaatan_sip')->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type');
            $table->bigInteger('file_size');
            $table->string('description')->nullable();
            
            $table->index('pemanfaatan_sip_id');
        });
    }

    public function down(): void
    {
        Schema::table('pemanfaatan_sip_dokumentasi', function (Blueprint $table) {
            $table->dropColumn([
                'pemanfaatan_sip_id',
                'file_name', 
                'file_path',
                'file_type',
                'file_size',
                'description'
            ]);
        });
    }
};