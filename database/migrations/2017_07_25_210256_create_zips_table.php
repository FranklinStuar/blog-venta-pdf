<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('languaje',5)->default('es');//idioma del post
            $table->string('file');
            $table->string('name');
            $table->integer('post_id')->unsigned();
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
        Schema::table('zips', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
        });
        Schema::dropIfExists('zips');
    }
}
