<?php

class JGroup extends \Eloquent {

public $table = "job_group";

public static $rules = [
		'name' => 'required'
	];

public static $messages = array(
        'name.required'=>'Please insert job group!',
    );

	// Don't forget to fill this array
	protected $fillable = [];


	public function employees(){

		return $this->hasMany('Employee');
	}

}