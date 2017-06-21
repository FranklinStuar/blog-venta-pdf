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
            $table->text('quienes_somos');
            $table->text('cuentas_premium');
            $table->text('publicidad');
            $table->text('politicas_condiciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('systems');
    }
}
