<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('vendor_id');
            $table->bigInteger('client_id');
            $table->bigInteger('order_id');
            $table->text('name');
            $table->text('order_brand');
            $table->text('offer_brand')->nullable();
            $table->text('count');
            $table->text('image')->nullable();
            $table->text('unit');
            $table->text('address')->nullable();
            $table->text('expire')->nullable();
            $table->bigInteger('promoted')->default(0);
            $table->bigInteger('status')->default(0);
            $table->bigInteger('views')->default(0);
            $table->bigInteger('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
