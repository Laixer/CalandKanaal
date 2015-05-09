<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sensors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->datetime('measurement_time');
			$table->integer('measurement_id')->unsigned();
			$table->foreign('measurement_id')->references('id')->on('measurements')->onUpdate('cascade')->onDelete('cascade');
			$table->float('val_1_0');
			$table->float('val_1_1');
			$table->float('val_2_0');
			$table->float('val_2_1');
			$table->float('val_3_0');
			$table->float('val_3_1');
			$table->float('val_4_0');
			$table->float('val_4_1');
			$table->float('val_5_0');
			$table->float('val_5_1');
			$table->float('val_6_0');
			$table->float('val_6_1');
			$table->float('val_7_0');
			$table->float('val_7_1');
			$table->float('val_8_0');
			$table->float('val_8_1');
			$table->float('val_9_0');
			$table->float('val_9_1');
			$table->float('val_10_0');
			$table->float('val_10_1');
			$table->float('val_11_0');
			$table->float('val_11_1');
			$table->float('val_12_0');
			$table->float('val_12_1');
			$table->float('val_13_0');
			$table->float('val_13_1');
			$table->float('val_14_0');
			$table->float('val_14_1');
			$table->float('val_15_0');
			$table->float('val_15_1');
			$table->float('val_16_0');
			$table->float('val_16_1');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sensors');
	}

}
