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
            $table->integer('time_use')->default(1);//tiempo que va a usar
            $table->enum('type_use',['day','month','year'])->default('month');
            $table->integer('role_id')->unsigned()->nullable();//rol asignado para visualizar los posts o categorías
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('role_id')->references('id')->on('roles');
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
            $table->dropForeign(['role_id']);
        });
        Schema::dropIfExists('post_prices');
    }
}
