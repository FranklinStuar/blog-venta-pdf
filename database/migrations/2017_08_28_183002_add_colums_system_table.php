<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('systems', function (Blueprint $table) {
            $table->string('sdk_stripe')->nullable();
            $table->string('pk_stripe')->nullable();
            $table->string('sdk_paypal')->nullable();
            $table->string('pk_paypal')->nullable();
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
            //
        });
    }
}
