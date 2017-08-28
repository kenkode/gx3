<?php

class EType extends \Eloquent {

public $table = "employee_type";

public static $rules = [
		'name' => 'required'
	];

public static $messages = array(
        'name.required'=>'Please insert employee type!',
    );
	// Don't forget to fill this array
	protected $fillable = [];


	public function employees(){

		return $this->hasMany('Employee');
	}

}