<?php

class JobGroupController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$jgroups = JGroup::all();

		return View::make('job_group.index', compact('jgroups'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('job_group.create');
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), JGroup::$rules,JGroup::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$jgroup = new JGroup;

		$jgroup->job_group_name = Input::get('name');

        $jgroup->organization_id = '1';

		$jgroup->save();

		return Redirect::route('job_group.index');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$jgroup = JGroup::findOrFail($id);

		return View::make('job_group.show', compact('jgroup'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$jgroup = JGroup::find($id);

		return View::make('job_group.edit', compact('jgroup'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$jgroup = JGroup::findOrFail($id);

		$validator = Validator::make($data = Input::all(), JGroup::$rules,JGroup::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$jgroup->job_group_name = Input::get('name');
		$jgroup->update();

		return Redirect::route('job_group.index');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		JGroup::destroy($id);

		return Redirect::route('job_group.index');
	}

}
