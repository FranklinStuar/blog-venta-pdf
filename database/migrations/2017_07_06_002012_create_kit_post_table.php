<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kit_post', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('post_price_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts');
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
        Schema::table('post_role', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['post_price_id']);
        });
        Schema::dropIfExists('kit_post');
    }
}
