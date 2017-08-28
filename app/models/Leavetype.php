<?php

class Leavetype extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function organization(){

		return $this->belongsTo('Organization');
	}

	public function leaveapplications(){

		return $this->hasMany('Leaveapplication');
	}


	public static function createLeaveType($data){

		$organization = Organization::getUserOrganization();

		$leavetype = new Leavetype;

		$leavetype->name = array_get($data, 'name');
		$leavetype->days = array_get($data, 'days');
		$leavetype->organization()->associate($organization);
		$leavetype->save();

	}


	public static function updateLeaveType($data, $id){

		$leavetype = Leavetype::find($id);

		$leavetype->name = array_get($data, 'name');
		$leavetype->days = array_get($data, 'days');
		$leavetype->update();

	}

}