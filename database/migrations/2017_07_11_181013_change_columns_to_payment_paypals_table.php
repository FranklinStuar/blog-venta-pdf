<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnsToPaymentPaypalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_paypals', function (Blueprint $table) {
            $table->dropForeign(['paypal_id']);
            $table->dropColumn('paypal_id');
            $table->string('line1');
            $table->string('line2')->nullable();
            $table->string('city');
            $table->string('postal_code');
            $table->string('country_code');
            $table->string('state');
            $table->string('recipient_name');
            $table->string('email');
            $table->string('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_paypals', function (Blueprint $table) {
            $table->integer('paypal_id')->unsigned()->nullable();

            $table->foreign('paypal_id')->references('id')->on('paypals');
            $table->dropColumn('line1');
            $table->dropColumn('line2');
            $table->dropColumn('city');
            $table->dropColumn('postal_code');
            $table->dropColumn('country_code');
            $table->dropColumn('state');
            $table->dropColumn('recipient_name');
            $table->dropColumn('email');
            $table->dropColumn('total');
        });
    }
}
