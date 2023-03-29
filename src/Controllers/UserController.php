<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\User;

class UserController extends BaseController
{
	protected $user;
	
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
            'cart' => null,
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

        // Check if email address is already in use

        $user = new User($data);

        $user->save();

        // Lưu ID của User vào session

        $_SESSION['user_id'] = $user->id;

        // Chuyển hướng về trang chủ

        redirect('/');
        exit;

    }

    // Hiển thị form đăng ký và thông báo lỗi nếu có
    render_view('register', [
        'user' => '',
        'cart' => null,
    ]);
}

	
    public function logOut(){
        $_SESSION['user_id'] = null;
        redirect('/');
    }
	public function login(){
		render_view('login', [
			'products' => Product::all(),
			'user' => '',
            'cart' => null,
		]);
	}

	public function signIn() 
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $data = [
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];
            
            // Tạo một đối tượng User và lưu dữ liệu vào CSDL
            $user = new User($data);
            $result = User::where('email', $user->email)->where('password', md5($user->password));
			if ($result) {
                $_SESSION['user_id'] = $result->id;
                if (isset($_SESSION['old_url'])) {
                    $old_url = $_SESSION['old_url'];
                    unset($_SESSION['old_url']);
                    redirect($old_url);
                } else {
                    redirect('/');
                }
                
			} else {
				// $_SESSION['message'] = 'Your email or password is incorrect.';
				render_view('login', [
					'products' => Product::all(),
					'user' => '',
				]);
			}
        }
	}
	

}