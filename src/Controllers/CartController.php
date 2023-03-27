<?php 
namespace App\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
// where('customer_email',$customer_email)->where('customer_password',$customer_password)->first();
class CartController
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function login(){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->user->where('email', $email)->where('password', $password);
        if($user)
        {
            return render_view('cart', [
                'product' => Product::all()]);
                
            
        } else {
            
        }
    }
    public function index()
    {
        
        render_view('cart', [
            'carts' => Cart::detail(),
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
            render_view('cart', [
                'cart' => Cart::detail(),
            ]);
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