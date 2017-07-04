<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleToPostPayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_pays', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->nullable();//rol asignado para visualizar los posts o categorías

            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_pays', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });
    }
}
