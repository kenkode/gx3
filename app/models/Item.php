<?php

class Item extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
	 'name' => 'required',
	 'item_size' => 'required',
	 'pprice' => 'required|regex:/^\d+(\.\d{2})?$/',
	 'sprice' => 'required|regex:/^\d+(\.\d{2})?$/'
	];

	public static $messages = array(
    	'item_make.required'=>'Please insert item make!',
    	'item_size.required'=>'Please insert item size!',
    	'pprice.required'=>'Please insert item purchase price!',
    	'pprice.regex'=>'Please insert a valid amount!',
    	'sprice.required'=>'Please insert item selling price!',
    	'sprice.regex'=>'Please insert a valid amount!',
    );

	// Don't forget to fill this array
	protected $fillable = [];

	public function erporderitems(){

		return $this->belongsToMany('Erporderitem');
	}

	public function stocks(){

		return $this->hasMany('Stock');
	}

	public function prices(){

    return $this->hasMany('Price');
    }

    public static function itemname($id){
    $item = Item::findOrFail($id);
    $name = $item->item_make;

		return $name;
    }

}