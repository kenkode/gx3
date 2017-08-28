<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeaveapplicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leaveapplications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned();
			$table->foreign('employee_id')->references('id')->on('employee');
			$table->date('application_date')->nullable();
			$table->date('applied_start_date')->nullable();
			$table->date('applied_end_date')->nullable();
			$table->integer('leavetype_id')->unsigned();
			$table->foreign('leavetype_id')->references('id')->on('leavetypes');
			$table->string('status')->nullable();
			$table->date('date_approved')->nullable();
			$table->date('date_rejected')->nullable();
			$table->date('date_amended')->nullable();
			$table->date('date_cancelled')->nullable();
			$table->date('approved_start_date')->nullable();
			$table->date('approved_end_date')->nullable();
			$table->date('actual_start_date')->nullable();
			$table->date('actual_end_date')->nullable();
			$table->integer('organization_id')->unsigned();
			$table->foreign('organization_id')->references('id')->on('organizations');
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
		Schema::drop('leaveapplications');
	}

}
