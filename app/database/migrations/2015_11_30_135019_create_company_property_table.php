<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyPropertyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_property', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned()->default('0')->index('company_property_employee_id_foreign');
			$table->string('property_name');
			$table->text('property_description')->nullable();
			$table->string('property_serial_number');
			$table->string('property_digital_serial_number');
			$table->string('issued_by');
			$table->date('property_issue_date');
			$table->date('property_return_date');
			$table->double('property_amount',15,2)->default('0.00');
			$table->char('returned',1);
			$table->string('received_by');
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
		Schema::drop('company_property');
	}

}
