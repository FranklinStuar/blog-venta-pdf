<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_visits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();//post l que se le hace la visita
            $table->integer('user_id')->unsigned()->nullable();//si se encuentra un usuario registrado
            $table->string('user_agent'); //navegador, kernel de OS, OS, kerner del navegador
            $table->string('browser');//navegador
            $table->string('kernel_os');//kernel del OS
            $table->string('os');// Sistema operativo
            $table->string('languaje');//Idioma
            $table->string('path');//path de la pagina visitada
            $table->string('ip',100);//la ip desde donde se realiza la actividad
            $table->string('country',15)->nullable();
            $table->string('long')->nullable(); //longitud para ser buscado por google maps
            $table->string('lat')->nullable();// lalitus para ser buscado por google maps
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
        Schema::dropIfExists('post_visits');
    }
}
