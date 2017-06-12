<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_pays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sponsor_id')->unsigned();//el sponsor donde se realiza
            $table->integer('author_id')->unsigned();//quien realiza la actividad
            $table->timestamps();
            $table->foreign('sponsor_id')->references('id')->on('sponsors');
            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsor_pays');
    }
}
