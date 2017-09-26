<?php

class TaxController extends \BaseController {

	/**
	 * Display a listing of branches
	 *
	 * @return Response
	 */
	public function index()
	{
		$taxes = Tax::all();

        if (! Entrust::can('view_tax') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('taxes.index', compact('taxes'));
	}
	}

	/**
	 * Show the form for creating a new branch
	 *
	 * @return Response
	 */
	public function create()
	{
		if (! Entrust::can('create_tax') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('taxes.create');
	}
	}

	/**
	 * Store a newly created branch in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Tax::$rules,Tax::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$tax = new Tax;

		$tax->name = Input::get('name');

        $tax->rate = Input::get('rate');

		$tax->save();

		return Redirect::route('taxes.index')->withFlashMessage('Tax successfully created!');
	}

	/**
	 * Display the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tax = Tax::findOrFail($id);

        if (! Entrust::can('view_tax') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('taxes.show', compact('tax'));
	}
	}

	/**
	 * Show the form for editing the specified branch.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tax = Tax::find($id);

        if (! Entrust::can('update_tax') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('taxes.edit', compact('tax'));
	}
	}

	/**
	 * Update the specified branch in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$tax = Tax::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Tax::$rules, Tax::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$tax->name = Input::get('name');
		$tax->rate = Input::get('rate');
		$tax->update();

		return Redirect::route('taxes.index')->withFlashMessage('Tax successfully updated!');
	}

	/**
	 * Remove the specified branch from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Tax::destroy($id);

        if (! Entrust::can('delete_tax') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return Redirect::route('taxes.index')->withDeleteMessage('Tax successfully deleted!');
	}
	}

}
