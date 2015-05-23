<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableSplice extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('measurements', function($table)
		{
			$table->dateTime('vecwsm_1_begin')->nullable();
			$table->dateTime('vecwsm_1_end')->nullable();
			$table->dateTime('vecwsm_2_begin')->nullable();
			$table->dateTime('vecwsm_2_end')->nullable();
			$table->dateTime('vecwsm_3_begin')->nullable();
			$table->dateTime('vecwsm_3_end')->nullable();
			$table->dateTime('vecwsm_4_begin')->nullable();
			$table->dateTime('vecwsm_4_end')->nullable();
			$table->dateTime('vecwsm_5_begin')->nullable();
			$table->dateTime('vecwsm_5_end')->nullable();
			$table->dateTime('vecwsm_6_begin')->nullable();
			$table->dateTime('vecwsm_6_end')->nullable();
			$table->dateTime('vecwsm_7_begin')->nullable();
			$table->dateTime('vecwsm_7_end')->nullable();
			$table->dateTime('vecwsm_8_begin')->nullable();
			$table->dateTime('vecwsm_8_end')->nullable();
			$table->dateTime('vecwsm_9_begin')->nullable();
			$table->dateTime('vecwsm_9_end')->nullable();
			$table->dateTime('vecwsm_10_begin')->nullable();
			$table->dateTime('vecwsm_10_end')->nullable();
			$table->dateTime('vecwsm_11_begin')->nullable();
			$table->dateTime('vecwsm_11_end')->nullable();
			$table->dateTime('vecwsm_12_begin')->nullable();
			$table->dateTime('vecwsm_12_end')->nullable();
			$table->dateTime('vecwsm_13_begin')->nullable();
			$table->dateTime('vecwsm_13_end')->nullable();
			$table->dateTime('vecwsm_14_begin')->nullable();
			$table->dateTime('vecwsm_14_end')->nullable();
			$table->dateTime('vecwsm_15_begin')->nullable();
			$table->dateTime('vecwsm_15_end')->nullable();
			$table->dateTime('vecwsm_16_begin')->nullable();
			$table->dateTime('vecwsm_16_end')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
