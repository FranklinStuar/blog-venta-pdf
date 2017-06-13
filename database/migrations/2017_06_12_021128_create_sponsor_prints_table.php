<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorPrintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_prints', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sponsor_id')->unsigned()->nullable();
            $table->timestamp('created_at')->nullable();
            $table->foreign('sponsor_id')->references('id')->on('sponsors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsor_prints', function (Blueprint $table) {
            $table->dropForeign(['sponsor_id']);
        });
        Schema::dropIfExists('sponsor_prints');
    }
}
