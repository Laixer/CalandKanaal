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
		Schema::create('measurement', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->dateTime('recording_date');
			$table->text('message')->nullable();
			$table->boolean('vecwsm_1_0');
			$table->boolean('vecwsm_1_1');
			$table->boolean('vecwsm_2_0');
			$table->boolean('vecwsm_2_1');
			$table->boolean('vecwsm_3_0');
			$table->boolean('vecwsm_3_1');
			$table->boolean('vecwsm_4_0');
			$table->boolean('vecwsm_4_1');
			$table->boolean('vecwsm_5_0');
			$table->boolean('vecwsm_5_1');
			$table->boolean('vecwsm_6_0');
			$table->boolean('vecwsm_6_1');
			$table->boolean('vecwsm_7_0');
			$table->boolean('vecwsm_7_1');
			$table->boolean('vecwsm_8_0');
			$table->boolean('vecwsm_8_1');
			$table->boolean('vecwsm_9_0');
			$table->boolean('vecwsm_9_1');
			$table->boolean('vecwsm_10_0');
			$table->boolean('vecwsm_10_1');
			$table->boolean('vecwsm_11_0');
			$table->boolean('vecwsm_11_1');
			$table->boolean('vecwsm_12_0');
			$table->boolean('vecwsm_12_1');
			$table->boolean('vecwsm_13_0');
			$table->boolean('vecwsm_13_1');
			$table->boolean('vecwsm_14_0');
			$table->boolean('vecwsm_14_1');
			$table->boolean('vecwsm_15_0');
			$table->boolean('vecwsm_15_1');
			$table->boolean('vecwsm_16_0');
			$table->boolean('vecwsm_16_1');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('measurement');
	}

}

