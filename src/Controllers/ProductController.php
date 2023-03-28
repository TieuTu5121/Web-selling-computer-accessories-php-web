<?php 
    namespace App\Controllers;

    use App\Models\Product;
    use App\Models\User;

    class ProductController extends BaseController
    {
        public function index()
        {
            $user = User::auth();
            
            render_view('home', [
                'products' => Product::all(),
                'user' => $user,
            ]); 
        }
        public function detail($id)
        {
            $user = User::auth();

            
            render_view('detail', [
                'products' => Product::all(),
                'product' => Product::findById($id),
                'user' => $user,
            ]);
        }

    }