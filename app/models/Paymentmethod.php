<?php

class Paymentmethod extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
	'name' => 'required',
	'account' => 'required'
	];

	public static $messages = array(
    	'name.required'=>'Please insert payment method!',
        'account.required'=>'Please select account!',
    );

	// Don't forget to fill this array
	protected $fillable = [];


	public function account(){
		return $this->belongsTo('Account');
	}


	public function erporders(){

		return $this->hasMany('Erporder');
	}

}