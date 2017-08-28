<?php

class ErporderitemsController extends \BaseController {

	/**
	 * Display a listing of erporderitems
	 *
	 * @return Response
	 */
	public function index()
	{
		$erporderitems = Erporderitem::all();

		return View::make('erporderitems.index', compact('erporderitems'));
	}

	/**
	 * Show the form for creating a new erporderitem
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('erporderitems.create');
	}

	/**
	 * Store a newly created erporderitem in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Erporderitem::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Erporderitem::create($data);

		
		return Redirect::route('erporderitems.index');
	}

	/**
	 * Display the specified erporderitem.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$erporderitem = Erporderitem::findOrFail($id);

		return View::make('erporderitems.show', compact('erporderitem'));
	}

	/**
	 * Show the form for editing the specified erporderitem.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$erporderitem = Erporderitem::find($id);

		return View::make('erporderitems.edit', compact('erporderitem'));
	}

	/**
	 * Update the specified erporderitem in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$erporderitem = Erporderitem::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Erporderitem::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$erporderitem->update($data);

		return Redirect::route('erporderitems.index');
	}

	/**
	 * Remove the specified erporderitem from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		/*Erporderitem::destroy($id);*/

		 $erporderitem = Erporderitem::find($id);

        
        $erporderitem->delete();

		return Redirect::route('erporderitems.index');
	}

}
