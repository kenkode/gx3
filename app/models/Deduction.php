<?php

class Deduction extends \Eloquent {

public $table = "deductions";

public static $rules = [
		'name' => 'required'
	];

public static $messages = array(
        'name.required'=>'Please insert deduction name!',
    );
	// Don't forget to fill this array
	protected $fillable = [];


	public function employees(){

		return $this->hasMany('Employee');
	}

}