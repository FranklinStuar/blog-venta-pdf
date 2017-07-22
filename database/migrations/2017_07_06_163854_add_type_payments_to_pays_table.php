<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypePaymentsToPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsor_pays', function (Blueprint $table) {
            $table->integer('payment_card_id')->unsigned()->nullable();
            $table->integer('payment_paypal_id')->unsigned()->nullable();
            $table->integer('payment_deposit_id')->unsigned()->nullable();

            $table->foreign('payment_paypal_id')->references('id')->on('payment_paypals');
            $table->foreign('payment_card_id')->references('id')->on('payment_cards');
            $table->foreign('payment_deposit_id')->references('id')->on('payment_deposits');
        });
        
        Schema::table('post_once_pays', function (Blueprint $table) {
            $table->integer('payment_card_id')->unsigned()->nullable();
            $table->integer('payment_paypal_id')->unsigned()->nullable();
            $table->integer('payment_deposit_id')->unsigned()->nullable();

            $table->foreign('payment_paypal_id')->references('id')->on('payment_paypals');
            $table->foreign('payment_card_id')->references('id')->on('payment_cards');
            $table->foreign('payment_deposit_id')->references('id')->on('payment_deposits');
        });
        
        Schema::table('post_pays', function (Blueprint $table) {
            $table->integer('payment_card_id')->unsigned()->nullable();
            $table->integer('payment_paypal_id')->unsigned()->nullable();
            $table->integer('payment_deposit_id')->unsigned()->nullable();

            $table->foreign('payment_paypal_id')->references('id')->on('payment_paypals');
            $table->foreign('payment_card_id')->references('id')->on('payment_cards');
            $table->foreign('payment_deposit_id')->references('id')->on('payment_deposits');
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
            $table->dropForeign(['payment_paypal_id']);
            $table->dropForeign(['payment_card_id']);
            $table->dropForeign(['payment_deposit_id']);
        });
        
        Schema::table('post_once_pays', function (Blueprint $table) {
            $table->dropForeign(['payment_paypal_id']);
            $table->dropForeign(['payment_card_id']);
            $table->dropForeign(['payment_deposit_id']);
        });
        
        Schema::table('post_pays', function (Blueprint $table) {
            $table->dropForeign(['payment_paypal_id']);
            $table->dropForeign(['payment_card_id']);
            $table->dropForeign(['payment_deposit_id']);
        });
        
    }
}
