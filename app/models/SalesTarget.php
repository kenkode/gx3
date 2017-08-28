<?php

class SalesTarget extends \Eloquent {

	
	// Add your validation rules here
	
	// Don't forget to fill this array
	protected $fillable = [];

	public static $rules = [
		'month' => 'required',
		'target_amount' => 'required',
		'date' => 'required'
	];

public static $messages = array(
        'month.required'=>'Please enter Month!',
        'target_amount.required'=>'Please enter Target Amount!',
        'date.required'=>'Please Enter date!',
    );


}