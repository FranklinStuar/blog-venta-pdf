<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostPriceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_price_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('excerpt')->nullable(); //detalles pequeño
            $table->integer('post_price_id')->unsigned();//el precio del post
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('post_price_id')->references('id')->on('post_prices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_price_details', function (Blueprint $table) {
            $table->dropForeign(['post_price_id']);
        });
        Schema::dropIfExists('post_price_details');
    }
}
