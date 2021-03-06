<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('facebook',50)->nullable();
            $table->string('instagram',50)->nullable();
            $table->string('youtube',50)->nullable();
            $table->string('email')->nullable(); //vista de contactenos
            $table->string('direccion',100)->nullable(); //vista de contactenos
            $table->string('telefono',15)->nullable(); //vista de contactenos
            $table->string('celular',15)->nullable(); //vista de contactenos
            $table->text('quienes_somos')->nullable();
            $table->text('cuentas_premium')->nullable();
            $table->text('publicidad')->nullable();
            $table->text('politicas_condiciones')->nullable();
            $table->integer('role_id')->unsigned()->index()->nullable(); //rol por defecto para nuevos usuarios
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('systems', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });
        Schema::dropIfExists('systems');
    }
}
