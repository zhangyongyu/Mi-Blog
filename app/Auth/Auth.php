<?php

namespace App\Auth;

use App\Models\User;

class Auth
{
	protected $container;

	public function __construct($container) {
		$this->container = $container;
	}

	public function user()
	{
		if($this->check())
			return User::find($_SESSION['user']);
	}

	public function check()
	{
		return isset($_SESSION['user']);
	}

	public function attempt($email, $password)
	{

		$user = User::where('email', $email)->first();

		if(!$user) {
			return false;
		}

		if (password_verify($password, $user->password)) {
			$_SESSION['user'] = $user->id;
			return true;
		}
		return false;
	}

	public function logout()
	{
		unset($_SESSION['user']);
	}
}
