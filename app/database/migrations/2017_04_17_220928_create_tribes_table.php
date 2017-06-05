<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTribesTable extends Migration {

	public function up()
	{
		Schema::create('tribes', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->float('year')->default('1');
			$table->integer('user_id');
		});
	}

	public function down()
	{
		Schema::drop('tribes');
	}
}