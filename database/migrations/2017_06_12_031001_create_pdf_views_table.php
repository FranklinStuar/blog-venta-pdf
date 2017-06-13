<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdfViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdf_views', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path_pdf'); //path del pdf que se visualizó
            $table->integer('post_id')->unsigned()->nullable(); //post donde se encuentra registrado el pdf
            $table->integer('user_id')->unsigned()->nullable();//el usuario que revisó si se encontró registrado
            $table->timestamp('created_at')->nullable();
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pdf_views', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('pdf_views');
    }
}
