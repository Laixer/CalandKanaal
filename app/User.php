<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{

	protected $hidden = array('password');

	public function getAuthIdentifier() {
		return $this->id;
	}

	public function getAuthPassword() {
		return $this->password;
	}

	public function getRememberToken() {
	}

	public function setRememberToken($token) {
	}

	public function getRememberTokenName() {
	}

}
