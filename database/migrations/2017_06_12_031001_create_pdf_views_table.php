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
            $table->string('pdf_name'); //nombre del pdf que se reviso
            $table->integer('post_id')->unsigned()->nullable(); //post donde se encuentra registrado el pdf
            $table->integer('user_id')->unsigned()->nullable();//el usuario que revisó si se encontró registrado
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
        Schema::dropIfExists('pdf_views');
    }
}
