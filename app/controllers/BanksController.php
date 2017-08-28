<?php

class BanksController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$banks = Bank::all();

		return View::make('banks.index', compact('banks'));
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('banks.create');
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Bank::$rules,Bank::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$bank = new Bank;

		$bank->bank_name = Input::get('name');

        $bank->organization_id = '1';

		$bank->save();

		return Redirect::route('banks.index');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$bank = Bank::findOrFail($id);

		return View::make('banks.show', compact('bank'));
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$bank = Bank::find($id);

		return View::make('banks.edit', compact('bank'));
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$bank = Bank::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Bank::$rules, Bank::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$bank->bank_name = Input::get('name');
		$bank->update();

		return Redirect::route('banks.index');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Bank::destroy($id);

		return Redirect::route('banks.index');
	}

}
