<?php

// namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
	public $timestamps = false; //set time to false
	protected $fillable = [
		'admin_email', 'admin_password', 'admin_name', 'admin_phone'
	];
	protected $primaryKey = 'admin_id';
	protected $table = 'tbl_admin';

	public function getAuthPassword()
	{
		return $this->admin_password;
	}
	public function roles()
	{
		return $this->belongsToMany('App\Roles');
	}
	// public function hasAnyRoles($roles){

	// 	if(is_array($roles)){
	// 		foreach($roles as $role){
	// 			if($this->hasRole($role)){
	// 				return true;
	// 			}
	// 		}
	// 	}else{
	// 		if($this->hasRole($roles)){
	// 			return true;
	// 		}
	// 	}
	// 	return false;
	// }
	public function hasAnyRoles($roles)
	{
		if (is_array($roles)) {
			foreach ($roles as $item) {
				if ($this->hasRole($item)) {
					return true;
				}
			}
		} else {
			if ($this->hasRole($roles)) {
				return true;
			}
		}
		return false;
	}
	public function hasRole($role)
	{
		if ($this->roles()->where('name', $role)->first()) {
			return true;
		}
		return false;
	}
}
