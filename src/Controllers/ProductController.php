<?php 
    namespace App\Controllers;

    use App\Models\Product;
    use App\Models\User;
    use App\Models\Cart;

    class ProductController extends BaseController
    {
        public function index()
        {
            $user = User::auth();
            $cart = Cart::findByUserId($user->id);
            render_view('home', [
                'products' => Product::all(),
                'user' => $user,
                'cart' => $cart,
            ]); 
        }
        public function detail($id)
        {
            $user = User::auth();

            $cart = Cart::findByUserId($user->id);

            render_view('detail', [
                'products' => Product::all(),
                'product' => Product::findById($id),
                'user' => $user,
                'cart' => $cart,
            ]);
        }

    }