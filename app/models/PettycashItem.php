<?php 

class PettycashItem extends Eloquent{

	protected $table = 'pettycash_items';

	// Add your validation rules here
	public static $rules = [
		
	];

	// Link with AccountTransaction controller
	public function accountTransaction(){
		return $this->belongsTo('AccountTransaction');
	}

}