<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostOncePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_once_pays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();//post donde se coloca un precio
            $table->integer('user_id')->unsigned();//post donde se coloca un precio
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('user_id')->references('id')->on('posts');
            $table->enum('status',['active','cancel','finished'])->default('active');//pagado, calcelado el servicio, finalizado
            $table->softDeletes();
            $table->timestamp('finish')->nullable();//fecha en la que finaliza el pago
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_once_pays', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('post_once_pays');
    }
}
