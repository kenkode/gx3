<?php

class Department extends \Eloquent {

public static $rules = [
		'name' => 'required'
	];

public static $messages = array(
        'name.required'=>'Please insert department name!',
    );
	// Don't forget to fill this array
	protected $fillable = [];


	public function employees(){

		return $this->hasMany('Employee');
	}

}