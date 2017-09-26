<?php

class ClientsController extends \BaseController {

	/**
	 * Display a listing of clients
	 *
	 * @return Response
	 */
	public function index()
	{
		$clients = Client::all();

		if (! Entrust::can('view_client') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{

		return View::make('clients.index', compact('clients'));
	}
	}

	/**
	 * Show the form for creating a new client
	 *
	 * @return Response
	 */
	public function create()
	{
		$items = Item::all();
		if (! Entrust::can('create_client') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('clients.create', compact('items'));
	}
	}

	/**
	 * Store a newly created client in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Client::$rules, Client::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$client = new Client;

		$client->name = Input::get('name');
		$client->date = date('Y-m-d');
		$client->contact_person = Input::get('cname');
		$client->email = Input::get('email_office');
		$client->contact_person_email = Input::get('email_personal');
		$client->contact_person_phone = Input::get('mobile_phone');
		$client->phone = Input::get('office_phone');
		$client->address = Input::get('address');
		$client->type = Input::get('type');
		$client->category = Input::get('category');
		$client->balance = Input::get('balance');
		/*$client->percentage_discount = Input::get('percentage_discount');*/
		$client->save();

		return Redirect::route('clients.index')->withFlashMessage('Client successfully created!');
	}

	/**
	 * Display the specified client.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$client = Client::findOrFail($id);

		if (! Entrust::can('view_client') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{

		return View::make('clients.show', compact('client'));
	}
	}

	/**
	 * Show the form for editing the specified client.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$client = Client::find($id);

		if (! Entrust::can('update_client') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{

		return View::make('clients.edit', compact('client'));
	}
	}

	/**
	 * Update the specified client in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$client = Client::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Client::rolesUpdate($client->id), Client::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$client->name = Input::get('name');
		$client->contact_person = Input::get('cname');
		$client->email = Input::get('email_office');
		$client->contact_person_email = Input::get('email_personal');
		$client->contact_person_phone = Input::get('mobile_phone');
		$client->phone = Input::get('office_phone');
		$client->address = Input::get('address');
		$client->type = Input::get('type');
		$client->category = Input::get('category');
		$client->balance = Input::get('balance');
		/*$client->percentage_discount = Input::get('percentage_discount');*/
		// $client->save();

		$client->update();

		return Redirect::route('clients.index')->withFlashMessage('Client successfully updated!');
	}

	/**
	 * Remove the specified client from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Client::destroy($id);

        if (! Entrust::can('delete_client') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return Redirect::route('clients.index')->withDeleteMessage('Client successfully deleted!');
	}
	}

}
