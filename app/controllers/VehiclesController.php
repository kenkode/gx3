<?php

class VehiclesController extends \BaseController {

	/**
	 * Display a listing of cars
	 *
	 * @return Response
	 */
	public function index()
	{
		$vehicles = Vehicle::all();

		return View::make('vehicles.index', compact('vehicles'));
	}

	/**
	 * Show the form for creating a new car
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('vehicles.create');
	}

	/**
	 * Store a newly created car in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Vehicle::$rules,Vehicle::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$vehicle = new Vehicle;

		
		$vehicle->date = date('Y-m-d');
		$vehicle->reg_no = Input::get('reg_no');
		$vehicle->model = Input::get('model');
		$vehicle->tank_capacity = Input::get('tank_capacity');			
		$vehicle->save();

		return Redirect::route('vehicles.index');
	}

	/**
	 * Display the specified car.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$vehicle = Vehicle::findOrFail($id);

		return View::make('vehicles.show', compact('vehicle'));
	}

	/**
	 * Show the form for editing the specified car.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$vehicle = Vehicle::find($id);

		return View::make('vehicles.edit', compact('vehicle'));
	}

	/**
	 * Update the specified car in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$vehicle = Vehicle::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Vehicle::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$vehicle->date = date('Y-m-d');
		$vehicle->reg_no = Input::get('reg_no');
		$vehicle->model = Input::get('model');
		$vehicle->tank_capacity = Input::get('tank_capacity');	
		$vehicle->update();

		return Redirect::route('vehicles.index');
	}

	/**
	 * Remove the specified car from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Vehicle::destroy($id);

		return Redirect::route('vehicles.index');
	}

}
