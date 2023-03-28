<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\CartDetail;

class CartController extends BaseController

{
    protected $user;
    protected $model;
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

    public function storeCartDetail($cartId, $data)
    {
        $cartDetail = new CartDetail($data);
        $cartDetail->cart_id = $cartId;
        if ($cartDetail->save()) {
            header("Location: /cart/{$cartId}/detail");
        } else {
            render_view('error', ['message' => 'Failed to create cart detail']);
        }
    }

    public function updateCartDetail($id, $data)
    {
        $cartDetail = CartDetail::findById($id);
        if ($cartDetail) {
            $cartDetail->fill($data);
            if ($cartDetail->save()) {
                header("Location: /cart/{$cartDetail->cart_id}/detail");
            } else {
                render_view('error', ['message' => 'Failed to update cart detail']);
            }
        } else {
            render_view('error', ['message' => 'Cart detail not found']);
        }
    }

    public function destroyCartDetail($id)
    {
        $cartDetail = CartDetail::findById($id);
        if ($cartDetail) {
            $cartId = $cartDetail->cart_id;
            if ($cartDetail->delete()) {
                header("Location: /cart/{$cartId}/detail");
            } else {
                render_view('error', ['message' => 'Failed to delete cart detail']);
            }
        } else {
            render_view('error', ['message' => 'Cart detail not found']);
        }
    }

    public function addCart($data)
    {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            // Nếu chưa đăng nhập, chuyển hướng sang trang login
            render_view('login',['users' => '']);
            exit;
        }

        // Nếu đã đăng nhập, kiểm tra xem user đã có cart chưa
        $user_id = $_SESSION['user_id'];
        $cart = $this->where(['user_id',$user_id])->first();
        if (!$cart) {
            // Nếu chưa có cart thì tạo mới
            $cart = new Cart(['user_id' => $user_id]);
            if (!$cart->save()) {
                render_view('error', ['message' => 'Thêm vào giỏ hàng thất bại']);
                exit;
            }
        }

        // Thêm sản phẩm vào cart detail
        $cartDetail = new CartDetail($data);
        $cartDetail->cart_id = $cart->id;
        if (!$cartDetail->save()) {
            render_view('error', ['message' => 'Không thể thêm vào giỏ hàng ']);
            exit;
        }
    }

}
