<?php

class LocationsController extends \BaseController {

	/**
	 * Display a listing of locations
	 *
	 * @return Response
	 */
	public function index()
	{
		$locations = Location::all();

		return View::make('locations.index', compact('locations'));
	}

	/**
	 * Show the form for creating a new location
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('locations.create');
	}

	/**
	 * Store a newly created location in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Location::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$location = new Location;

		$location->name = Input::get('name');
		$location->description = Input::get('description');
		$location->save();

		return Redirect::route('locations.index')->withFlashMessage('Store has been successfully created!');
	}

	/**
	 * Display the specified location.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$location = Location::findOrFail($id);

		return View::make('locations.show', compact('location'));
	}

	/**
	 * Show the form for editing the specified location.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$location = Location::find($id);

		return View::make('locations.edit', compact('location'));
	}

	/**
	 * Update the specified location in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$location = Location::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Location::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$location->name = Input::get('name');
		$location->description = Input::get('description');
		$location->update();

		return Redirect::route('locations.index')->withFlashMessage('Store has been successfully updated!');

	}

	/**
	 * Remove the specified location from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Location::destroy($id);


		return Redirect::route('locations.index')->withFlashMessage('Store has been successfully removed!');

	}

}
