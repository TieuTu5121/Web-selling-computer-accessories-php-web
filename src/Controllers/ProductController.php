<?php 
namespace App\Controllers;

use App\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        
        render_view('home', [
            'products' => Product::all()
        ]);
    }
    public function detail($id)
    {

        
        render_view('detail', [
            'products' => Product::all(),
            'product' => Product::findById($id)
        ]);
    }

}