<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create table for storing categories
		Schema::create('categories', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('parent_id')->unsigned()->nullable();
			$table->integer('order')->default(1);
			$table->string('name');
			$table->string('slug')->unique();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('parent_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
    Schema::table('categories', function (Blueprint $table) {
        $table->dropForeign(['parent_id']);
    });
		Schema::drop('categories');
	}
}
