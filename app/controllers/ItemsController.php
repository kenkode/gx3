<?php

class ItemsController extends \BaseController {

	/**
	 * Display a listing of items
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Item::all();

		if (! Entrust::can('view_item') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{

		return View::make('items.index', compact('items'));
	    }
	}

	/**
	 * Show the form for creating a new item
	 *
	 * @return Response
	 */
	public function create()
	{
		if (! Entrust::can('create_item') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{
		return View::make('items.create');
	    }
	}

	/**
	 * Store a newly created item in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Item::$rules, Item::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$item = new Item;

		$item->item_make = Input::get('item_make');
		$item->item_size = Input::get('item_size');
		$item->date = date('Y-m-d');
		$item->description = Input::get('description');
		$item->purchase_price= Input::get('pprice');
		$item->selling_price = Input::get('sprice');
		$item->sku= Input::get('sku');
		$item->tag_id = Input::get('tag');
		$item->reorder_level = Input::get('reorder');
		$item->save();

		return Redirect::route('items.index')->withFlashMessage('Item successfully created!');
	}

	/**
	 * Display the specified item.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$item = Item::findOrFail($id);

		if (! Entrust::can('view_item') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{

		return View::make('items.show', compact('item'));
	}
	}

	/**
	 * Show the form for editing the specified item.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item = Item::find($id);

		if (! Entrust::can('update_item') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{

		return View::make('items.edit', compact('item'));
	}
	}

	/**
	 * Update the specified item in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$item = Item::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Item::$rules, Item::$messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		if (! Entrust::can('confirm_update_item') ) // Checks the current user
        {

        $name = Input::get('name');
        $size = Input::get('item_size');
		$description = Input::get('description');
		$purchase_price= Input::get('pprice');
		$selling_price = Input::get('sprice');
		$sku= Input::get('sku');
		$tag_id = Input::get('tag');
		$reorder_level = Input::get('reorder');
        $receiver_id = Confide::user()->id;
		$username = Confide::user()->username;

		if($tag_id == ""){
		$tag_id = "null";
		}else{
		$tag_id = $tag_id;
		}
		if($sku == ""){
		$sku = "null";
		}else{
		$sku = $sku;
		}
		if($size == ""){
		$size = "null";
		}else{
		$size = $size;
		}

		$users = DB::table('roles')
		->join('assigned_roles', 'roles.id', '=', 'assigned_roles.role_id')
		->join('users', 'assigned_roles.user_id', '=', 'users.id')
		->join('permission_role', 'roles.id', '=', 'permission_role.role_id') 
		->where("permission_id",34)->get();

		$key = md5(uniqid());

		foreach ($users as $user) {

		$email = $user->email;
			
        $send_mail = Mail::send('emails.item', array('name' => $user->username, 'username' => $username,'itemname' => $name,'size' => $size,'description' => $description,'pprice' => $purchase_price,'sprice' => $selling_price,'sku' => $sku,'tagid' => $tag_id,'reorderlevel' => $reorder_level,'receiver' => $receiver_id,'confirmer' => $user->id,'key'=>$key,'id' => $id), function($message) use($email)
        {   
		    $message->from('info@lixnet.net', 'Gas Express');
		    $message->to($email, 'Gas Express')->subject('Item Update!');

    
        });
        }

        return Redirect::to('items')->with('notice', 'Admin approval is needed for this update');
        }else{

		$item->item_make = Input::get('name');
		$item->item_size = Input::get('item_size');
		$item->description = Input::get('description');
		$item->purchase_price= Input::get('pprice');
		$item->selling_price = Input::get('sprice');
		$item->sku= Input::get('sku');
		$item->tag_id = Input::get('tag');
		$item->reorder_level = Input::get('reorder');
        $item->confirmed_id = Confide::user()->id;
        $item->receiver_id = Confide::user()->id;
		$item->update();

		return Redirect::route('items.index')->withFlashMessage('Item successfully updated!');
	}
	}

	public function approveitem($name,$size,$description,$pprice,$sprice,$sku,$tagid,$reorderlevel,$receiver,$confirmer,$key,$id)
	{

		$item = Item::findOrFail($id);
        if($item->confirmation_code != $key){
		$item->item_make = $name;
		$item->item_size = $size;
		$item->description = $description;
		$item->purchase_price= $pprice;
		$item->selling_price = $sprice;
		$item->sku= $sku;
		$item->tag_id = $tagid;
		$item->reorder_level = $reorderlevel;
        $item->confirmed_id = $confirmer;
        $item->receiver_id = $receiver;
        $item->confirmation_code = $key;
		$item->update();

		return "<strong><span style='color:green'>Item update for ".$name." successfully approved!</span></strong>";
	}else{
         return "<strong><span style='color:red'>Item has already been approved!</span></strong>";
	}
	
	}

	/**
	 * Remove the specified item from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Item::destroy($id);

		if (! Entrust::can('delete_item') ) // Checks the current user
        {
        return Redirect::to('dashboard')->with('notice', 'you do not have access to this resource. Contact your system admin');
        }else{

		return Redirect::route('items.index')->withDeleteMessage('Item successfully deleted!');
	}
	}

	public function code($id)
	{
		$item = Item::find($id);
		return View::make('items.code', compact('item'));
	}

	public function generate($id)
	{

		$item = Item::find($id);
		return View::make('items.generate', compact('item'));
	}

}
