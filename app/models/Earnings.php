<?php

class Earnings extends \Eloquent {
	/*

	use \Traits\Encryptable;


	protected $encryptable = [

		'earnings_name',
		'earnings_amount',
		
	];
	*/

public $table = "earnings";

public static $rules = [
		'employee' => 'required',
		'earning' => 'required',
		'amount' => 'required|regex:/^\d+(\.\d{2})?$/'
	];

public static $messages = array(
        'employee.required'=>'Please select employee!',
        'earning.required'=>'Please select earning type!',
        'amount.required'=>'Please insert amount!',
        'amount.regex'=>'Please insert a valid amount!',
    );

	// Don't forget to fill this array
	protected $fillable = [];


	public function employee(){

		return $this->belongsTo('Employee');
	}

}