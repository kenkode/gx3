<?php

class SalestargetController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$salestargets = SalesTarget::all();

		return View::make('salestargets.index', compact('salestargets'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('salestargets.create');
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), SalesTarget::$rules,SalesTarget::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$salestarget = new SalesTarget;

		$salestarget->month = Input::get('month');

        $salestarget->target_amount = Input::get('target_amount');

        $salestarget->target_date = date("Y-m-d",strtotime(Input::get('date')));

		$salestarget->save();

		return Redirect::route('salestargets.index')->withFlashMessage('Sales Target successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$salestarget = SalesTarget::findOrFail($id);

		return View::make('salestargets.show', compact('salestarget'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$salestarget = SalesTarget::find($id);

		return View::make('salestargets.edit', compact('salestarget'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$salestarget = SalesTarget::findOrFail($id);

		$validator = Validator::make($data = Input::all(), SalesTarget::$rules, SalesTarget::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$salestarget->month = Input::get('month');
		$salestarget->target_amount = Input::get('target_amount');
		$salestarget->target_date = date("Y-m-d",strtotime(Input::get('date')));
		$salestarget->update();

		return Redirect::route('salestargets.index')->withFlashMessage('Target successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		SalesTarget::destroy($id);

		return Redirect::route('salestargets.index')->withDeleteMessage('Target successfully removed!');
	}

}
