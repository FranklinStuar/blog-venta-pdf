<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',90);
            $table->string('excerpt');
            $table->string('web');
            $table->timestamp('finish'); //fecha en la que finaliza el sponsor
            $table->integer('user_id')->unsigned();
            $table->string('image')->nullable();
            $table->string('phone',20)->nullable();
            $table->string('address',90)->nullable();
            $table->string('url_facebook',90)->nullable();
            $table->string('url_twitter',90)->nullable();
            $table->string('url_instagram',90)->nullable();
            $table->string('url_youtube',90)->nullable();
            $table->enum('status',['published','finished','created','canceled'])->default('created');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    /*
     * published: publica
     * finished:finalizo el tiempo del sponsor
     * created: se creo el sponsor
     * canceled: se cancelo el sponsor en la visualizacion 
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('sponsors');
    }
}
