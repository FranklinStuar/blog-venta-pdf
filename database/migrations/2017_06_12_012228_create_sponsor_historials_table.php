<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_historials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned();//quien realiza la actividad
            $table->integer('sponsor_id')->unsigned();//el sponsor donde se realiza
            $table->enum('activity',['publish','finish','create','cancel','destroy','pay'])->default('create');
            $table->string('details')->nullable();
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('sponsor_id')->references('id')->on('sponsors');
        });
    }
    /*
     * published: publica
     * finished:finalizo el tiempo del sponsor
     * created: se creo el sponsor
     * canceled: se cancelo el sponsor en la visualizacion 
     * destroy: elimina el sponsor
     * pay: que ha pagado por el sponsor
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsor_historials', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['sponsor_id']);
        });
        Schema::dropIfExists('sponsor_historials');
    }
}
