<?php

class CreateHolidaysController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$holidays = Holiday::all();

		return View::make('holidays.index',compact('holidays'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('holidays.create');
	}


	/**
	 * Store a newly created resource in storage.
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

		$holidays = new Holiday;
        $holidays->holidays_name = Input::get('holidays_name');
		$holidays->holidays_date = Input::get('holidays_date');
		$holidays->save();
		return Redirect::route('holidays.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$holiday= Holiday::findOrFail($id);
		return View::make('holidays.show',compact('holiday'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$holiday= Holiday::find($id);
		return View::make('holidays.edit',compact('holiday'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$holidays= Holiday::findOrFail($id);
	  $validator = Validator::make($data = Input::all(), Holiday::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $holidays->holidays_name = Input::get('holidays_name');
		$holidays->holidays_date = Input::get('holidays_date');
		$holidays->update();
		return Redirect::route('holidays.index');
	}


	/**
	 * Remove the specified resource from storage.
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
