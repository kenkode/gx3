<?php

class ReliefsController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$reliefs = Relief::all();

		return View::make('reliefs.index', compact('reliefs'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('reliefs.create');
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Relief::$rules,Relief::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$relief = new Relief;

		$relief->relief_name = Input::get('name');

        $relief->organization_id = '1';

		$relief->save();

		return Redirect::route('reliefs.index');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$relief = Relief::findOrFail($id);

		return View::make('reliefs.show', compact('relief'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$relief = Relief::find($id);

		return View::make('reliefs.edit', compact('relief'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$relief = Relief::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Relief::$rules,Relief::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$relief->relief_name = Input::get('name');
		$relief->update();

		return Redirect::route('reliefs.index');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Relief::destroy($id);

		return Redirect::route('reliefs.index');
	}

}
