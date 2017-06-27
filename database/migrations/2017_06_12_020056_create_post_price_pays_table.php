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
            $table->string('observations')->nullable();//observacion para cuando se cancele o se bloquee el plan
            $table->integer('user_id')->unsigned();//quien realiza la actividad
            $table->integer('post_price_id')->unsigned();//de donde se realiza el pago
            $table->enum('method_payment',['check','card','cash','deposit','paypal']);//metodo de pago solo para efectivo, depósito, paypal y tarjeta
            $table->enum('status',['active','cancel','finished'])->default('active');//pagado, calcelado el servicio, finalizado
            $table->timestamp('finish');//fecha en la que finaliza el pago
            $table->timestamp('created_at')->nullable();

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
        Schema::table('post_pays', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['post_price_id']);
        });
        Schema::dropIfExists('post_pays');
    }
}
