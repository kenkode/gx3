<?php

class Stock extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public function location(){
		return $this->belongsTo('Location');
	}

	public function item(){
		return $this->belongsTo('Item');
	}


	public static function getStockAmount($item){

		$qin = DB::table('stocks')->where('item_id', '=', $item->id)->where('is_confirmed', '=', 1)->sum('quantity_in');
		$qout = DB::table('stocks')->where('item_id', '=', $item->id)->where('is_confirmed', '=', 1)->sum('quantity_out');

		$stock = $qin - $qout;

		return $stock;
	}

	public static function getOpeningStock($item){

		$qin = DB::table('stocks')->where('item_id', '=', $item->id)->sum('quantity_in');
		$qout = DB::table('stocks')->where('item_id', '=', $item->id)->sum('quantity_out');

		$stock = $qin - $qout;
		
		$opening = $stock;

		return $opening;
	}


	public static function totalPurchases($item){

		$qin = DB::table('stocks')->where('item_id', '=', $item->id)->sum('quantity_in');
		

		return $qin;
	}

	public static function totalsales($item){

		
		$qout = DB::table('stocks')->where('item_id', '=', $item->id)->sum('quantity_out');

		

		return $qout;
	}




	public static function addStock($item, $location, $quantity, $date){

        if (! Entrust::can('confirm_stock') ) // Checks the current user
        {
		$stock = new Stock;

		$stock->date = $date;
		$stock->item()->associate($item);
		$stock->location()->associate($location);
		$stock->quantity_in = $quantity;
		$stock->receiver_id = Confide::user()->id;
		$stock->is_confirmed = 0;
		$stock->save();

		$name = $item->item_make;
        $loc = $location->name;
        $id = $stock->id;
		$username = Confide::user()->username;

		$users = DB::table('roles')
		->join('assigned_roles', 'roles.id', '=', 'assigned_roles.role_id')
		->join('users', 'assigned_roles.user_id', '=', 'users.id')
		->join('permission_role', 'roles.id', '=', 'permission_role.role_id') 
		->select("users.id","email","username")
		->where("permission_id",30)->get();

		$key = md5(uniqid());

		foreach ($users as $user) {

		Notification::notifyUser($user->id,"Hello, Approval to receive stock is required","stock","confirmstock/".$id."/".$name."/".$user->id."/".$key, $key);

		$email = $user->email;

		$send_mail = Mail::send('emails.stock', array('name' => $user->username, 'username' => $username,'itemname' => $name,'location' => $loc,'quantity' => $quantity,'confirmer' => $user->id,'key'=>$key,'id' => $id), function($message) use($email)
        {   
		    $message->from('info@lixnet.net', 'Gas Express');
		    $message->to($email, 'Gas Express')->subject('Stock Confirmation!');

    
        });
      	}
        }else{
        $stock = new Stock;

		$stock->date = $date;
		$stock->item()->associate($item);
		$stock->location()->associate($location);
		$stock->quantity_in = $quantity;
		$stock->confirmed_id = Confide::user()->id;
		$stock->receiver_id = Confide::user()->id;
		$stock->is_confirmed = 1;
		$stock->save();
        }


	}


	public static function removeStock($item, $location, $quantity, $date){

		$stock = new Stock;

		$stock->date = $date;
		$stock->item()->associate($item);
		$stock->location()->associate($location);
		$stock->quantity_out = $quantity;
		$stock->save();



	}




}