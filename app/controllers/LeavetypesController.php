<?php

class LeavetypesController extends \BaseController {

	/**
	 * Display a listing of leavetypes
	 *
	 * @return Response
	 */
	public function index()
	{
		$leavetypes = Leavetype::all();

		return View::make('leavetypes.index', compact('leavetypes'));
	}

	/**
	 * Show the form for creating a new leavetype
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('leavetypes.create');
	}

	/**
	 * Store a newly created leavetype in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Leavetype::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Leavetype::createLeaveType($data);

		return Redirect::route('leavetypes.index');
	}

	/**
	 * Display the specified leavetype.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$leavetype = Leavetype::findOrFail($id);

		return View::make('leavetypes.show', compact('leavetype'));
	}

	/**
	 * Show the form for editing the specified leavetype.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$leavetype = Leavetype::find($id);

		return View::make('leavetypes.edit', compact('leavetype'));
	}

	/**
	 * Update the specified leavetype in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$leavetype = Leavetype::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Leavetype::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Leavetype::updateLeaveType($data, $id);

		return Redirect::route('leavetypes.index');
	}

	/**
	 * Remove the specified leavetype from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Leavetype::destroy($id);

		return Redirect::route('leavetypes.index');
	}

}
