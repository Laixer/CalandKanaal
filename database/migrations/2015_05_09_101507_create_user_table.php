<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('firstname', 20);
			$table->string('lastname', 20);
			$table->string('email', 100)->unique();
			$table->string('password', 64);
			$table->boolean('active')->default('1');
			$table->dateTime('last_login')->nullable();
			$table->enum('priv', ['user', 'admin'])->default('user');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
