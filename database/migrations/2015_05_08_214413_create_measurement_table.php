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
			$table->string('name', 64)->nullable();
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
			$table->string('vecwsm_1_name', 64)->nullable();
			$table->string('vecwsm_2_name', 64)->nullable();
			$table->string('vecwsm_3_name', 64)->nullable();
			$table->string('vecwsm_4_name', 64)->nullable();
			$table->string('vecwsm_5_name', 64)->nullable();
			$table->string('vecwsm_6_name', 64)->nullable();
			$table->string('vecwsm_7_name', 64)->nullable();
			$table->string('vecwsm_8_name', 64)->nullable();
			$table->string('vecwsm_9_name', 64)->nullable();
			$table->string('vecwsm_10_name', 64)->nullable();
			$table->string('vecwsm_11_name', 64)->nullable();
			$table->string('vecwsm_12_name', 64)->nullable();
			$table->string('vecwsm_13_name', 64)->nullable();
			$table->string('vecwsm_14_name', 64)->nullable();
			$table->string('vecwsm_15_name', 64)->nullable();
			$table->string('vecwsm_16_name', 64)->nullable();
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

