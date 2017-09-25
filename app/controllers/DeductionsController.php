<?php

class DeductionsController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$deductions = Deduction::all();

		Audit::logaudit('Deductions', 'view', 'viewed deduction list ');

		return View::make('deductions.index', compact('deductions'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('deductions.create');
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Deduction::$rules, Deduction::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$deduction = new Deduction;

		$deduction->deduction_name = Input::get('name');

        $deduction->organization_id = '1';

		$deduction->save();

		Audit::logaudit('Deductions', 'create', 'created: '.$deduction->deduction_name);

		return Redirect::route('deductions.index');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$deduction = Deduction::findOrFail($id);

		return View::make('deductions.show', compact('deduction'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$deduction = Deduction::find($id);

		return View::make('deductions.edit', compact('deduction'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$deduction = Deduction::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Deduction::$rules, Deduction::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$deduction->deduction_name = Input::get('name');
		$deduction->update();

		Audit::logaudit('Deductions', 'update', 'updated: '.$deduction->deduction_name);

		return Redirect::route('deductions.index');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$deduction = Deduction::findOrFail($id);
		
		Deduction::destroy($id);

		Audit::logaudit('Deductions', 'delete', 'deleted: '.$deduction->deduction_name);

		return Redirect::route('deductions.index');
	}

}
