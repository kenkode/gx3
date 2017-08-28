<?php

class StocksController extends \BaseController {

	/**
	 * Display a listing of stocks
	 *
	 * @return Response
	 */
	public function index()
	{
		$stocks = Stock::all();

		$items = Item::all();

		$stock_in = DB::table('stocks')
         ->join('items', 'stocks.item_id', '=', 'items.id')
         ->get();

		return View::make('stocks.index', compact('stocks', 'items','stock_in'));
	}

	/**
	 * Show the form for creating a new stock
	 *
	 * @return Response
	 */
	public function create()
	{
		$items = Item::all();
		$locations = Location::all();

		return View::make('stocks.create', compact('items', 'locations'));
	}

	/**
	 * Store a newly created stock in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Stock::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$item_id = Input::get('item');
		$location_id = Input::get('location');
		$date = date('Y-m-d');
		$item = Item::findOrFail($item_id);
		$location = Location::find($location_id);
		$quantity = Input::get('quantity');
		/*$date = Input::get('date');*/

		

		Stock::addStock($item, $location, $quantity, $date);

		return Redirect::route('stocks.index')->withFlashMessage('stock has been successfully updated!');
	}

	/**
	 * Display the specified stock.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$stock = Stock::findOrFail($id);

		return View::make('stocks.show', compact('stock'));
	}

	/**
	 * Show the form for editing the specified stock.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$stock = Stock::find($id);

		return View::make('stocks.edit', compact('stock'));
	}

	/**
	 * Update the specified stock in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$stock = Stock::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Stock::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$stock->update($data);

		return Redirect::route('stocks.index');
	}

	/**
	 * Remove the specified stock from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Stock::destroy($id);

		return Redirect::route('stocks.index');
	}

}
