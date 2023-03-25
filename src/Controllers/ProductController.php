<?php 
namespace App\Controllers;

use App\Models\Product;

class ProductController
{
    public function index()
    {
        
        render_view('home', [
            'products' => Product::all()
        ]);
    }
}