<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBsipProfileTable extends Migration
{
    public function up()
    {
        Schema::create('bsip_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('m_bsip_id'); 
            $table->text('description');
            $table->string('image_url');
            $table->timestamps();

            $table->foreign('m_bsip_id')->references('id')->on('m_bsip')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bsip_profile');
    }
}