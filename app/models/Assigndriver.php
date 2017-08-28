<?php

class Assigndriver extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		/*'driver_name' => 'required',
		'vehicle_reg_no' => 'required',
		'morgue' => 'required',
		'date' => 'required'*/		
		
	];

	public static $messages = array(
       /* 'driver_name.required'=>'Enter Driver Name!',
        'vehicle_reg_no.required'=>'Please Enter Vehicle Registration Number!',
        'morgue.required'=>'Please Enter Morgue!',
        'date.required'=>'Please Enter Date!'
        */
        
    );

	// Don't forget to fill this array
	protected $fillable = [];


	

	public static function drivername($id){
      $driver = DB::table('assigndrivers')
		   ->join('drivers','assigndrivers.driver','=','drivers.id')           
           /*->where('first_name',$id)*/
           ->first();

      return $driver->first_name.' '.$driver->surname;
	}

	

}