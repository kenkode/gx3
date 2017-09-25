<?php

class Tax extends \Eloquent {

	
	// Add your validation rules here
	
	// Don't forget to fill this array
	protected $fillable = [];

	public static $rules = [
		'name' => 'required',
		'rate' => 'required'
	];

public static $messages = array(
        'name.required'=>'Please insert tax type!',
        'rate.required'=>'Please insert tax rate!',
    );


}