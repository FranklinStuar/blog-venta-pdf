<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypePaymentsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('credit_card_id')->unsigned()->nullable();
            $table->integer('paypal_id')->unsigned()->nullable();
            $table->enum('automatic',['paypal','card','none'])->default('none');//es para elegir si desea que se hagan cobros automaticos

            $table->foreign('credit_card_id')->references('id')->on('credit_cards');
            $table->foreign('paypal_id')->references('id')->on('paypals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['credit_card_id']);
            $table->dropForeign(['paypal_id']);
        });
    }
}
