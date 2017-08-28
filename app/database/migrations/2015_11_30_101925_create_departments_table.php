<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('departments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('department_name');
			$table->integer('organization_id')->unsigned()->default('0')->index('departments_organization_id_foreign');
			$table->timestamps();
		});

		DB::table('departments')->insert(array(
            array('department_name' => 'Information Technology','organization_id' => '1'),
            array('department_name' => 'Management','organization_id' => '1'),
            array('department_name' => 'Marketing','organization_id' => '1'),
            array('department_name' => 'Finance','organization_id' => '1'),
            array('department_name' => 'Human Resource','organization_id' => '1'),
        ));
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('departments');
	}
}
