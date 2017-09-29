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

		if (! Entrust::can('view_pricing') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{

		return View::make('prices.index', compact('prices'));
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
		$clients = Client::all();
		if (! Entrust::can('create_pricing') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('prices.create', compact('items','clients'));
	}
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
        
        if (! Entrust::can('view_pricing') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('prices.show', compact('price'));
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
		$price = Price::find($id);
		$items = Item::all();
		$clients = Client::all();

        if (! Entrust::can('update_pricing') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('prices.edit', compact('price','items','clients'));
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
		$price = Price::findOrFail($id);

		$validator = Validator::make($data = Input::all(),Price::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if (! Entrust::can('confirm_update_pricing') ) // Checks the current user
        {

		$client_id = Input::get('client');		
		$item_id = Input::get('item');
		$discount = Input::get('discount');

		$client = Client::find($client_id);
		$item = Item::find($item_id);
		$username = Confide::user()->username;

		$users = DB::table('roles')
		->join('assigned_roles', 'roles.id', '=', 'assigned_roles.role_id')
		->join('users', 'assigned_roles.user_id', '=', 'users.id')
		->join('permission_role', 'roles.id', '=', 'permission_role.role_id') 
		->select("users.id","email","username")
		->where("permission_id",104)->get();

		$key = md5(uniqid());

		foreach ($users as $user) {

		Notification::notifyUser($user->id,"Approval to pricing for item".$item->item_make." is required","price","approvepriceupdate/".$client->id."/".$item->id."/".$discount."/".Confide::user()->id."/".$user->id."/".$key."/".$id,$key);

		$email = $user->email;

		$send_mail = Mail::send('emails.pricing', array('name' => $user->username, 'username' => $username,'client' => $client,'item' => $item,'discount' => $discount,'receiver'=>Confide::user()->id,'confirmer' => $user->id,'key'=>$key,'id' => $id), function($message) use($email)
        {   
		    $message->from('info@lixnet.net', 'Gas Express');
		    $message->to($email, 'Gas Express')->subject('Pricing Update!');

    
        });
	    }
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

    public function approveprice($client,$item,$discount,$receiver,$confirmer,$key,$id)
	{
		$price = Price::findOrFail($id);
        if($price->confirmation_code != $key){
		$price->date = date('Y-m-d');
		$price->client_id = $client;		
		$price->item_id = $item;
		$price->Discount = $discount;		
        $price->confirmed_id = $confirmer;
        $price->receiver_id = $receiver;
        $price->confirmation_code = $key;
		$price->update();

		$i = Item::find($item);

		$notification = Notification::where('confirmation_code',$key)->where('user_id',$confirmer)->first();
		$notification->is_read = 1;
		$notification->update();

		return "<strong><span style='color:green'>Price update for ".$i->item_make." successfully approved!</span></strong>";
	}else{
		return "<strong><span style='color:red'>Item Price has already approved!</span></strong>";
	}
	
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

        if (! Entrust::can('delete_pricing') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return Redirect::route('prices.index')->withDeleteMessage('Client Discount successfully deleted!');
	}
	}

}
