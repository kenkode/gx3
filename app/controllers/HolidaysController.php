<?php

class HolidaysController extends \BaseController {

	/**
	 * Display a listing of holidays
	 *
	 * @return Response
	 */
	public function index()
	{
		$holidays = Holiday::all();

		return View::make('holidays.index', compact('holidays'));
	}

	/**
	 * Show the form for creating a new holiday
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('holidays.create');
	}

	/**
	 * Store a newly created holiday in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Holiday::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Holiday::createHoliday($data);

		return Redirect::route('holidays.index');
	}

	/**
	 * Display the specified holiday.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$holiday = Holiday::findOrFail($id);

		return View::make('holidays.show', compact('holiday'));
	}

	/**
	 * Show the form for editing the specified holiday.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$holiday = Holiday::find($id);

		return View::make('holidays.edit', compact('holiday'));
	}

	/**
	 * Update the specified holiday in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$holiday = Holiday::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Holiday::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Holiday::updateHoliday($data, $id);

		return Redirect::route('holidays.index');
	}

	/**
	 * Remove the specified holiday from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Holiday::destroy($id);

		return Redirect::route('holidays.index');
	}

}
