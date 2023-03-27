<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\User;

class UserController
{
    public function index()
	{
		render_view('home', [
			'users' => User::all()
		]);
	}
    public function register()
	{
		render_view('register', [
			'products' => Product::all(),
			'user' => '',
		]);
	}
	public function addUser()
	{
		

		
	}
	public function login()
	{
		
	}
}