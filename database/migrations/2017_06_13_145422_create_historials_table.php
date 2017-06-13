<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();//si se encuentra un usuario registrado
            $table->string('user_agent'); //navegador, kernel de OS, OS, kerner del navegador
            $table->string('browser')->nullable();//navegador
            $table->string('kernel_os')->nullable();//kernel del OS
            $table->string('os')->nullable();// Sistema operativo
            $table->string('languaje');//Idioma
            $table->string('path');//path de la pagina visitada
            $table->string('ip',100);//la ip desde donde se realiza la actividad
            $table->string('country',15)->nullable();
            $table->string('long')->nullable(); //longitud para ser buscado por google maps
            $table->string('lat')->nullable();// lalitus para ser buscado por google maps
            $table->timestamp('created_at')->nullable();

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
        Schema::dropIfExists('historials');
    }
}
