<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHistorialToTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_visits', function (Blueprint $table) {
            $table->integer('historial_id')->unsigned()->nullable(); //historial al que se enlaza
            $table->foreign('historial_id')->references('id')->on('historials');
        });
        Schema::table('post_historials', function (Blueprint $table) {
            $table->integer('historial_id')->unsigned()->nullable(); //historial al que se enlaza
            $table->foreign('historial_id')->references('id')->on('historials');
        });
        Schema::table('pdf_views', function (Blueprint $table) {
            $table->integer('historial_id')->unsigned()->nullable(); //historial al que se enlaza
            $table->foreign('historial_id')->references('id')->on('historials');
        });
        Schema::table('sponsor_prints', function (Blueprint $table) {
            $table->integer('historial_id')->unsigned()->nullable(); //historial al que se enlaza
            $table->foreign('historial_id')->references('id')->on('historials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_visits', function (Blueprint $table) {
            $table->dropForeign(['historial_id']);
        });
        Schema::table('pdf_views', function (Blueprint $table) {
            $table->dropForeign(['historial_id']);
        });
        Schema::table('sponsor_prints', function (Blueprint $table) {
            $table->dropForeign(['historial_id']);
        });
    }
}
