<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('measurements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->dateTime('recording_date');
			$table->text('message')->nullable();
			$table->string('ascloc', 256);
			$table->boolean('vecwsm_1')->default('1');
			$table->boolean('vecwsm_2')->default('1');
			$table->boolean('vecwsm_3')->default('1');
			$table->boolean('vecwsm_4')->default('1');
			$table->boolean('vecwsm_5')->default('1');
			$table->boolean('vecwsm_6')->default('1');
			$table->boolean('vecwsm_7')->default('1');
			$table->boolean('vecwsm_8')->default('1');
			$table->boolean('vecwsm_9')->default('1');
			$table->boolean('vecwsm_10')->default('1');
			$table->boolean('vecwsm_11')->default('1');
			$table->boolean('vecwsm_12')->default('1');
			$table->boolean('vecwsm_13')->default('1');
			$table->boolean('vecwsm_14')->default('1');
			$table->boolean('vecwsm_15')->default('1');
			$table->boolean('vecwsm_16')->default('1');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('measurements');
	}

}

