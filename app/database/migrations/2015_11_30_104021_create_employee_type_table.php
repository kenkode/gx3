<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_type', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employee_type_name');
			$table->integer('organization_id')->unsigned()->default('0')->index('employee_type_organization_id_foreign');
			$table->timestamps();
		});

		DB::table('employee_type')->insert(array(
            array('employee_type_name' => 'Full Time','organization_id' => '1'),
            array('employee_type_name' => 'Contract','organization_id' => '1'),
            array('employee_type_name' => 'Internship','organization_id' => '1'),
        ));
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employee_type');
	}

}
