<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeReliefTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_relief', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('relief_id')->unsigned()->default('0')->index('employee_relief_relief_id_foreign');
			$table->integer('employee_id')->unsigned()->default('0')->index('employee_relief_employee_id_foreign');
			$table->string('relief_amount')->default('0.00');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employee_relief');
	}


}
