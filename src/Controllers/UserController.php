<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\User;

class UserController extends BaseController
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
	public function signUp()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'password' => $_POST['password'] ?? '',
            ];
            
            // Tạo một đối tượng User và lưu dữ liệu vào CSDL
            $user = new User($data);
            $user->save();

            // Lưu ID của User vào session
            $_SESSION['user_id'] = $user->id; 


            // Chuyển hướng về trang chủ
            redirect('/');
			
            exit;
        }

        // Nếu không phải là phương thức POST, hiển thị form đăng ký
        render_view('home', [
            'user' => '',
        ]);
	} 	

	public function login(){
		render_view('login', [
			'products' => Product::all(),
			'user' => '',
		]);
	}
	

}