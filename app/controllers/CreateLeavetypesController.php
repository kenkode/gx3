<?php

class CreateLeavetypesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$leavetypes= Leavetype::all();

		return View::make('leavetypes.index',compact('leavetypes'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('leavetypes.create');
	}


	/**
	 * Store a newly created resource in storage.
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

		$leavetypes = new Leavetype;
        $leavetypes->leavetypes_name = Input::get('name');
		$leavetypes->leavetypes_days= Input::get('leavetypes_days');
		$leavetypes->save();

		return Redirect::route('leavetypes.index');	//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$leavetypes=Leavetype::findOrFail($id);
		return View::make('leavetypes.show',compact('leavetypes'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$leavetypes=Leavetype::find($id);
		return View::make('leavetypes.edit',compact('leavetypes'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$leavetypes = Leavetype::findOrFail($id);
		$validator = Validator::make($data = Input::all(), Leavetype::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $leavetypes->leavetypes_name = Input::get('name');
		$leavetypes->leavetypes_days= Input::get('leavetypes_days');
		$leavetypes->update();
		return Redirect::route('leavetypes.index');
	}


	/**
	 * Remove the specified resource from storage.
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
