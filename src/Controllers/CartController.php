<?php 
namespace App\Controllers;

use App\Models\Cart;

class CartController
{
    public function index()
    {
        
        render_view('cart', [
            'carts' => Cart::all()
        ]);
    }
    public function show($id)
    {
        $cart = Cart::findById($id);
        if ($cart) {
            render_view('cart_detail', ['cart' => $cart]);
        } else {
            render_view('error', ['message' => 'Cart not found']);
        }
    }

    public function store($data)
    {
        $cart = new Cart($data);
        if ($cart->save()) {
            header('Location: /cart/'.$cart->id);
        } else {
            render_view('error', ['message' => 'Failed to create cart']);
        }
    }

    public function update($id, $data)
    {
        $cart = Cart::findById($id);
        if ($cart) {
            $cart->fill($data);
            if ($cart->save()) {
                header('Location: /cart/'.$cart->id);
            } else {
                render_view('error', ['message' => 'Failed to update cart']);
            }
        } else {
            render_view('error', ['message' => 'Cart not found']);
        }
    }

    public function destroy($id)
    {
        $cart = Cart::findById($id);
        if ($cart) {
            if ($cart->delete()) {
                header('Location: /cart');
            } else {
                render_view('error', ['message' => 'Failed to delete cart']);
            }
        } else {
            render_view('error', ['message' => 'Cart not found']);
        }
    }
} 