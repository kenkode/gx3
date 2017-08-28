<?php

class ItemTracker extends Eloquent{
	protected $table = 'item_tracker';

	public static function getItem($id){
		$item = DB::table('items')->select('name')->where('id', $id)->first();
		return $item->name;
	}

	public static function getClient($id){
		$client = DB::table('clients')->select('name')->where('id', $id)->first();
		return $client->name;
	}
}