<?php

class AllowancesController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$allowances = Allowance::all();

		



		return View::make('allowances.index', compact('allowances'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('allowances.create');
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Allowance::$rules, Allowance::$messsages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$allowance = new Allowance;

		$allowance->allowance_name = Input::get('name');

        $allowance->organization_id = '1';

		$allowance->save();

		Audit::logaudit('Allowances', 'create', 'created: '.$allowance->allowance_name);


		return Redirect::route('allowances.index');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$allowance = Allowance::findOrFail($id);

		return View::make('allowances.show', compact('allowance'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$allowance = Allowance::find($id);

		return View::make('allowances.edit', compact('allowance'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$allowance = Allowance::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Allowance::$rules, Allowance::$messsages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$allowance->allowance_name = Input::get('name');
		$allowance->update();

		Audit::logaudit('Allowances', 'update', 'updated: '.$allowance->allowance_name);

		return Redirect::route('allowances.index');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$allowance = Allowance::findOrFail($id);
		Allowance::destroy($id);

		Audit::logaudit('Allowances', 'delete', 'deleted: '.$allowance->allowance_name);

		return Redirect::route('allowances.index');
	}

}
