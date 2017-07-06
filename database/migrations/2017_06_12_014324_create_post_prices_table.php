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
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('post_prices');
    }
}
