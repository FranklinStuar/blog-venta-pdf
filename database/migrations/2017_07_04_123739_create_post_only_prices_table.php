<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostOnlyPricesTable extends Migration
{
    /**
     * Precios solo para un post en específico
     *
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_once_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->double('price','6,2');
            $table->integer('time');
            $table->enum('type_time',['day','month','year']);
            $table->integer('post_id')->unsigned();//post donde se coloca un precio
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('post_id')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_once_prices', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
        });
        Schema::dropIfExists('post_once_prices');
    }
}
