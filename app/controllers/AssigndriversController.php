<?php

class AssigndriversController extends \BaseController {

	/**
	 * Display a listing of cars
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$assigndrivers = DB::table('assigndrivers')
		   ->join('drivers','assigndrivers.driver','=','drivers.id')           
           ->join('vehicles','assigndrivers.reg_no','=','vehicles.id')
           

           ->select('drivers.id as id','assigndrivers.date as date','drivers.first_name','drivers.surname','vehicles.reg_no as reg_no','time_out','vehicles.model as model','oil_level','water_level','fuel_level')
                  
           ->get();


		return View::make('assigndrivers.index', compact('assigndrivers'));
	}

	/**
	 * Show the form for creating a new car
	 *
	 * @return Response
	 */
	public function create()

	{
		$drivers = DB::table('drivers')           

           ->select('drivers.id as id','first_name','surname','other_names')

           ->get();

        $vehicles = Vehicle::all();

		return View::make('assigndrivers.create', compact('drivers','vehicles'));
	}

	/**
	 * Store a newly created car in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Assigndriver::$rules, Assigndriver::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$assigndriver = new Assigndriver;

		$assigndriver->driver = Input::get('driver_name');
		$assigndriver->contact = Input::get('contact');
		$assigndriver->time_out = Input::get('time_out');
		$assigndriver->reg_no = Input::get('reg_no');
		$assigndriver->model = Input::get('model');
		$assigndriver->date = Input::get('date');
		$assigndriver->oil_level = Input::get('oil_level');
		$assigndriver->water_level = Input::get('water_level');
		$assigndriver->fuel_level = Input::get('fuel_level');
		$assigndriver->tire_pressure = Input::get('tire_pressure');
		$assigndriver->general_comments = Input::get('general_comments');

		$assigndriver->save();

		return Redirect::route('assigndrivers.index');
	}

	/**
	 * Display the specified car.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

   $drivers = DB::table('assigndrivers')
		   ->join('drivers','assigndrivers.driver','=','drivers.id')           
           ->join('vehicles','assigndrivers.reg_no','=','vehicles.id')           
           ->where('assigndrivers.id',$id)
           ->first();

	return View::make('assigndrivers.show', compact('drivers'));
	}

	/**
	 * Show the form for editing the specified car.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$assigndriver = Assigndriver::find($id);
		$drivers = DB::table('drivers')           

           ->select('drivers.id as id','drivers.first_name','drivers.surname')

           ->get();

        $vehicles = Vehicle::all();

		return View::make('assigndrivers.edit', compact('drivers','vehicles','assigndriver'));

		/*return View::make('drivers.edit', compact('driver'));*/
	}

	/**
	 * Update the specified car in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$assigndriver = Assigndriver::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Assigndriver::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$assigndriver->driver = Input::get('driver_name');
		$assigndriver->contact = Input::get('contact');
		$assigndriver->time_out = Input::get('time_out');
		$assigndriver->reg_no = Input::get('reg_no');
		$assigndriver->model = Input::get('model');
		$assigndriver->date = Input::get('date');
		$assigndriver->oil_level = Input::get('oil_level');
		$assigndriver->water_level = Input::get('water_level');
		$assigndriver->fuel_level = Input::get('fuel_level');
		$assigndriver->tire_pressure = Input::get('tire_pressure');
		$assigndriver->general_comments = Input::get('general_comments');
		

		$assigndriver->update();

		return Redirect::route('assigndrivers.index');
	}

	/**
	 * Remove the specified car from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Assigndriver::destroy($id);

		return Redirect::route('assigndrivers.index');
	}

}
