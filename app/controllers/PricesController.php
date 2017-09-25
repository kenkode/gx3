<?php

class PricesController extends \BaseController {

	/**
	 * Display a listing of clients
	 *
	 * @return Response
	 */
	public function index()
	{
		$prices = Price::all();

		return View::make('prices.index', compact('prices'));
	}

	/**
	 * Show the form for creating a new client
	 *
	 * @return Response
	 */
	public function create()
	{
		$items = Item::all();
		$clients = Client::all();
		return View::make('prices.create', compact('items','clients'));
	}

	/**
	 * Store a newly created client in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Price::$rules, Price::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$price = new Price;

		$price->date = date('Y-m-d');
		$price->client_id = Input::get('client');		
		$price->item_id = Input::get('item');
		$price->Discount = Input::get('discount');		
		$price->save();
		return Redirect::route('prices.index')->withFlashMessage('Discount successfully Set!');
	}

	/**
	 * Display the specified client.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$price = Price::findOrFail($id);

		return View::make('prices.show', compact('price'));
	}

	/**
	 * Show the form for editing the specified client.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$price = Price::find($id);
		$items = Item::all();
		$clients = Client::all();

		return View::make('prices.edit', compact('price','items','clients'));
	}

	/**
	 * Update the specified client in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$price = Price::findOrFail($id);

		$validator = Validator::make($data = Input::all(),Price::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if (! Entrust::can('update_items') ) // Checks the current user
        {

		$client_id = Input::get('client');		
		$item_id = Input::get('item');
		$discount = Input::get('discount');

		$client = Client::find($client_id);
		$item = Item::find($item_id);
		$username = Confide::user()->username;

		$send_mail = Mail::send('emails.pricing', array('name' => 'Victor Kotonya', 'username' => $username,'client' => $client,'item' => $item,'discount' => $discount,'receiver'=>Confide::user()->id,'id' => $id), function($message)
        {   
		    $message->from('info@lixnet.net', 'Gas Express');
		    $message->to('victor.kotonya@lixnet.net', 'Gas Express')->subject('Pricing Update!');

    
        });
        return Redirect::to('prices')->with('notice', 'Admin approval is needed for this update');
        }else{

		$price->date = date('Y-m-d');
		$price->client_id = Input::get('client');		
		$price->item_id = Input::get('item');
		$price->Discount = Input::get('discount');
		$price->confirmed_id = Confide::user()->id;
        $Price->receiver_id = Confide::user()->id;	
		$price->update();

		return Redirect::route('prices.index')->withFlashMessage('Client Discount successfully updated!');
	}
	}

    public function approveprice($client,$item,$discount,$receiver,$id)
	{
		$price = Price::findOrFail($id);

		$price->date = date('Y-m-d');
		$price->client_id = $client;		
		$price->item_id = $item;
		$price->Discount = $discount;		
        $price->confirmed_id = 2;
        $price->receiver_id = $receiver;
		$price->update();

		$i = Item::find($item);

		return "<strong><span style='color:green'>Price update for ".$i->item_make." successfully approved!</span></strong>";
	
	}

	/**
	 * Remove the specified client from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Price::destroy($id);

		return Redirect::route('prices.index')->withDeleteMessage('Client Discount successfully deleted!');
	}

}
