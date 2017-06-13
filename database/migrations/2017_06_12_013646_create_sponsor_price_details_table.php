<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorPriceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_price_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('excerpt')->nullable();
            $table->integer('sponsor_price_id')->unsigned();//el precio del sponsor donde se realiza
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sponsor_price_id')->references('id')->on('sponsor_prices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsor_price_details', function (Blueprint $table) {
            $table->dropForeign(['sponsor_price_id']);
        });
        Schema::dropIfExists('sponsor_price_details');
    }
}
