<?php 

namespace App\Controllers;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class OrderController {
    public function index()
    {
        $user = User::auth();
        
        render_view('order', [
            'orders' => Order::all(),
            'products' => Product::all(),
            'user' => $user,
        ]); 
    }
}
