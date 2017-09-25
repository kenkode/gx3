<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeductionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deductions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('deduction_name');
			$table->integer('organization_id')->unsigned()->default('0')->index('deductions_organization_id_foreign');
			$table->timestamps();
		});

		DB::table('deductions')->insert(array(
            array('deduction_name' => 'Salary Advance','organization_id' => '1'),
            array('deduction_name' => 'Loans','organization_id' => '1'),
            array('deduction_name' => 'Savings','organization_id' => '1'),
            array('deduction_name' => 'Breakages and spoilages','organization_id' => '1'),
        ));
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('deductions');
	}


}
