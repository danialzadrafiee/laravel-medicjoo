<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerSelectedTable extends Migration
{

    public function up()
    {
        Schema::create('banner_selected', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('location_1');
            $table->string('location_2');
            $table->string('image');
            $table->string('link');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('banner_selected');
    }
}
