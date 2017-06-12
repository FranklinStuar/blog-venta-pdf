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
        Schema::create('post_pays', function (Blueprint $table) {
            $table->increments('id');
            $table->double('price',6,2); //cuanto paga
            $table->integer('user_id')->unsigned();//quien realiza la actividad
            $table->integer('post_price_id')->unsigned();//de donde se realiza el pago
            $table->timestamp('finish');//fecha en la que finaliza el pago
            $table->integer('post_id')->unsigned()->nullable();//si se paga por algun post
            $table->integer('category_id')->unsigned()->nullable();//si se paga por una categoria
            $table->enum('status',['paid','cancel_service','finished'])->default('paid');//pagado, calcelado el servicio, finalizado
            $table->timestamp('created_at')->nullable();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('post_price_id')->references('id')->on('post_prices');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('category_id')->references('id')->on('categories');
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
