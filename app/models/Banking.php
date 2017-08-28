<?php

class Banking extends \Eloquent {

	 protected $table = 'banking';

	// Add your validation rules here
	public static $rules = [
		//'account_to' => 'required',
		//'account_from' => 'required',
		//'amount' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	
	public function account(){

		return $this->belongsTo('Accounts');
	}

}