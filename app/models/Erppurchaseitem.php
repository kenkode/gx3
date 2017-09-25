<?php

class Erppurchaseitem extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function erppurchase(){

		return $this->belongsTo('Erppurchase');
	}

	public function item(){
		return $this->belongsTo('Item');
	}

}