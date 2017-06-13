<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_historials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();//quien realiza la actividad
            $table->integer('post_id')->unsigned();//el post donde se realiza
            $table->enum('activity',['publish','draft','pending','edit','destroy','pay','cancel_pay'])->default('draft');
            $table->string('details')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('post_historials', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['post_id']);
        });
        Schema::dropIfExists('post_historials');
    }
}
