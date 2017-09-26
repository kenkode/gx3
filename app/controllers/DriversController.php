<?php

class DriversController extends \BaseController {

	/**
	 * Display a listing of cars
	 *
	 * @return Response
	 */
	public function index()
	{
		$drivers = Driver::all();

		if (! Entrust::can('view_driver') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{

		return View::make('drivers.index', compact('drivers'));
	}
	}

	/**
	 * Show the form for creating a new car
	 *
	 * @return Response
	 */
	public function create()
	{
		if (! Entrust::can('create_driver') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('drivers.create');
	}
	}

	/**
	 * Store a newly created car in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Driver::$rules,Driver::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$driver = new Driver;

		
		$driver->date = date('Y-m-d');
		$driver->surname = Input::get('surname');
		$driver->first_name = Input::get('first_name');
		$driver->other_names = Input::get('other_names');
		$driver->contact = Input::get('contact');
		$driver->employee_no = Input::get('employee_no');					
		$driver->save();

		return Redirect::route('drivers.index');
	}

	/**
	 * Display the specified car.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$driver = Driver::findOrFail($id);

        if (! Entrust::can('view_driver') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('drivers.show', compact('driver'));
	}
	}

	/**
	 * Show the form for editing the specified car.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$driver = Driver::find($id);

        if (! Entrust::can('update_driver') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('drivers.edit', compact('driver'));
	}
	}

	/**
	 * Update the specified car in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$driver = Driver::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Driver::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$driver->date = Input::get('date');
		$driver->surname = Input::get('surname');
		$driver->first_name = Input::get('first_name');
		$driver->other_names = Input::get('other_names');
		$driver->contact = Input::get('contact');
		$driver->employee_no = Input::get('employee_no');	
		$driver->update();

		return Redirect::route('drivers.index');
	}

	/**
	 * Remove the specified car from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Driver::destroy($id);

        if (! Entrust::can('delete_driver') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return Redirect::route('drivers.index');
	}
	}

}
