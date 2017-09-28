<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

	public static function getRole($id){
		$role = DB::table("roles")
		      ->join("assigned_roles","roles.id", '=',"assigned_roles.role_id")
		      ->where("user_id",$id)
		      ->select("roles.name")
		      ->first();
		return $role->name;
	}

}