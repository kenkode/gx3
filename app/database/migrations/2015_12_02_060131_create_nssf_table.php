<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNssfTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('social_security', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('tier',30);
			$table->double('income_from',15,2)->default('0.00');
			$table->double('income_to',15,2)->default('0.00');
			$table->double('ss_amount_employee',15,2)->default('0.00');
			$table->double('ss_amount_employer',15,2)->default('0.00');
			$table->integer('organization_id');
			$table->timestamps();
		});

		DB::table('social_security')->insert(array(
            array('tier' => 'Tier I','income_from' => '0.00', 'income_to' => '0.00', 'ss_amount_employee' => '0.00', 'ss_amount_employer' => '0.00', 'organization_id' => '1'),
            array('tier' => 'Tier I','income_from' => '1.00', 'income_to' => '99000000.00', 'ss_amount_employee' => '200.00', 'ss_amount_employer' => '200.00', 'organization_id' => '1'),
        ));
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('social_security');
	}

}
