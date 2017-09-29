<?php

class Notification extends \Eloquent {



	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];


	public static function notifyUser( $userid, $message, $type, $link, $key){

	$notification = new Notification;

    $notification->user_id = $userid;
    $notification->message = $message;
    $notification->is_read = 0;
    $notification->type = $type;
    $notification->link = $link;
    $notification->confirmation_code = $key;
    $notification->save();

	}


}