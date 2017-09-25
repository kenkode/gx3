<?php

class EmployeeReliefController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$rels = ERelief::all();
		return View::make('employee_relief.index', compact('rels'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		$employees = Employee::all();
		$reliefs = Relief::all();
		return View::make('employee_relief.create',compact('employees','reliefs'));
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), ERelief::$rules, ERelief::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$rel = new ERelief;

		$rel->employee_id = Input::get('employee');

		$rel->relief_id = Input::get('relief');

        $rel->relief_amount = Input::get('amount');

		$rel->save();

		return Redirect::route('employee_relief.index');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$rel = ERelief::findOrFail($id);

		return View::make('employee_relief.show', compact('rel'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$rel = ERelief::find($id);
		$employees = Employee::all();
        $reliefs = Relief::all();
		return View::make('employee_relief.edit', compact('rel','employees','reliefs'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rel = ERelief::findOrFail($id);

		$validator = Validator::make($data = Input::all(), ERelief::$rules, ERelief::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$rel->employee_id = Input::get('employee');

		$rel->relief_id = Input::get('relief');

        $rel->relief_amount = Input::get('amount');

		$rel->update();

		return Redirect::route('employee_relief.index');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		ERelief::destroy($id);

		return Redirect::route('employee_relief.index');
	}

}
