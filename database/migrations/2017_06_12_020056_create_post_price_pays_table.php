<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostPricePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_price_pays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();//quien realiza la actividad
            $table->integer('post_price_id')->unsigned();//quien realiza la actividad
            $table->timestamp('finish');//fecha en la que finaliza el pago
            $table->enum('status',['paid','cancel_service','finished'])->default('paid');//pagdo, calcelado el servicio, finalizado
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('post_price_pays');
    }
}
