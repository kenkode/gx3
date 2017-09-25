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

		return View::make('items.index', compact('items'));
	}

	/**
	 * Show the form for creating a new item
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('items.create');
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

		return View::make('items.show', compact('item'));
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

		return View::make('items.edit', compact('item'));
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

		if (! Entrust::can('update_items') ) // Checks the current user
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

        $send_mail = Mail::send('emails.item', array('name' => 'Victor Kotonya', 'username' => $username,'itemname' => $name,'size' => $size,'description' => $description,'pprice' => $purchase_price,'sprice' => $selling_price,'sku' => $sku,'tagid' => $tag_id,'reorderlevel' => $reorder_level,'receiver' => $receiver_id,'id' => $id), function($message)
        {   
		    $message->from('info@lixnet.net', 'Gas Express');
		    $message->to('victor.kotonya@lixnet.net', 'Gas Express')->subject('Item Update!');

    
        });
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

	public function approveitem($name,$size,$description,$pprice,$sprice,$sku,$tagid,$reorderlevel,$receiver,$id)
	{
		$item = Item::findOrFail($id);

		$item->item_make = $name;
		$item->item_size = $size;
		$item->description = $description;
		$item->purchase_price= $pprice;
		$item->selling_price = $sprice;
		$item->sku= $sku;
		$item->tag_id = $tagid;
		$item->reorder_level = $reorderlevel;
        $item->confirmed_id = 2;
        $item->receiver_id = Confide::user()->id;
		$item->update();

		return "<strong><span style='color:green'>Item update for ".$name." successfully approved!</span></strong>";
	
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

		return Redirect::route('items.index')->withDeleteMessage('Item successfully deleted!');
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
