<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrintsToSponsorPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsor_pays', function (Blueprint $table) {
            $table->integer('prints');//cantidad de impresiones permitidas
            $table->integer('print_count')->default(0);//cantidad de impresiones permitidas
            $table->timestamp('finish_date')->nullable();//fecha en la que finaliza el pago
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsor_pays', function (Blueprint $table) {
            //
        });
    }
}
