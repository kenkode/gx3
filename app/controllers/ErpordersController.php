<?php

class ErpordersController extends \BaseController {

	/**
	 * Display a listing of erporders
	 *
	 * @return Response
	 */
	public function index()
	{
		$erporders = Erporder::all();

		return View::make('erporders.index', compact('erporders'));
	}

	/**
	 * Show the form for creating a new erporder
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('erporders.create');
	}

	/**
	 * Store a newly created erporder in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Erporder::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Erporder::create($data);

		   			

		return Redirect::route('erporders.index');
	}

	/**
	 * Display the specified erporder.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$erporder = Erporder::find($id);

		return View::make('erporders.show', compact('erporder'));
	}

	/**
	 * Show the form for editing the specified erporder.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$erporder = Erporder::find($id);

		return View::make('erporders.edit', compact('erporder'));
	}

	/**
	 * Update the specified erporder in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$erporder = Erporder::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Erporder::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$erporder->update($data);

		return Redirect::route('erporders.index');
	}

	/**
	 * Remove the specified erporder from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Erporder::destroy($id);

		return Redirect::route('erporders.index');
	}

}
