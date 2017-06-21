<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_pays', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('method_payment',['card','chash','deposit','paypal']);//metodo de pago solo para efectivo, depósito, paypal y tarjeta
            $table->double('price_month',6,2)->default(0);//cantidad que paga el usuario, paga por mes pero usa solo lo que gasta
            $table->integer('author_id')->unsigned();//quien realiza la actividad
            $table->integer('sponsor_id')->unsigned();//el sponsor donde se realiza
            $table->integer('sponsor_price_id')->unsigned();//el sponsor donde se realiza
            $table->enum('status',['active','canceled','finish'])->default('active');
            $table->timestamp('created_at')->nullable();
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('sponsor_id')->references('id')->on('sponsors');
            $table->foreign('sponsor_price_id')->references('id')->on('sponsor_prices');
            $table->softDeletes();
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsor_pays', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['sponsor_id']);
            $table->dropForeign(['sponsor_price_id']);
        });
        Schema::dropIfExists('sponsor_pays');
    }
}
