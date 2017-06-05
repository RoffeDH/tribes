<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration {

	public function up()
	{
		Schema::create('characters', function($table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('gender');
			$table->string('strength');
			$table->string('skill');
			$table->integer('food')->default(0);
			$table->integer('grain')->default(0);
			$table->integer('baskts')->default(0);
			$table->integer('spears')->default(0);
			$table->boolean('pregnant')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('characters');
	}

}
