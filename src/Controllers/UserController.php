<?php
namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function index()
	{
		render_view('home', [
			'users' => User::all()
		]);
	}
    
	public function AddUser()
	{
		$data = [
			'title' => 'Thêm người dùng mới',
			'error' => session_get_flash('error'),
			'post_url' => '/users',
			'user' => new User()
		];

		render_view('singin', $data);
	}

}