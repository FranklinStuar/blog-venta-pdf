<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->double('price',6,2);
            $table->integer('months')->default(1);
            $table->enum('destiny',['all','category','post'])->detault('all');
            $table->integer('post_id')->unsigned()->nullable();//el post al que se va el precio
            $table->integer('category_id')->unsigned()->nullable();//la categoria del post al que se le coloca precio
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }
    /**
     * all: todos los posts y categorias
     * category: solo una categoria de post en particular
     * post: solo un post en particular
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_prices', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('post_prices');
    }
}
