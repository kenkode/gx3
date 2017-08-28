<?php

class NhifRates extends \Eloquent {

	public $table = "hospital_insurance";

public static $rules = [
		'i_from' => 'required|regex:/^\d+(\.\d{2})?$/',
		'i_to' => 'required|regex:/^\d+(\.\d{2})?$/',
		'amount' => 'required|regex:/^\d+(\.\d{2})?$/',
	];

public static $messages = array(
        'i_from.required'=>'Please insert income from amount!',
        'i_from.regex'=>'Please insert a valid income from amount!',
        'i_to.required'=>'Please insert income to amount!',
        'i_to.regex'=>'Please insert a valid income to amount!',
        'amount.required'=>'Please insert amount!',
        'amount.regex'=>'Please insert a valid amount!',
    );

	// Don't forget to fill this array
	protected $fillable = [];

}