<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\User;

class CartController extends BaseController
{   
    public function index()
    {   
        if (!isset($_SESSION['user_id'])) {
            // Nếu chưa đăng nhập, chuyển hướng sang trang login
            redirect('/login');
            exit;
        }
        $products = Product::all();
        $user = User::auth();
        $cart = Cart::findByUserId($user->id);
        $details = CartDetail::details($cart->id);
        render_view('test', [
            'products' => $products,
            'user' => $user,
            'cart' => $cart,
            'details' => $details,
        ]);
    }
    
    
    public function addCart()
    {
            // Lấy dữ liệu từ form
            $data = [
                'product_id' => $_POST['product_id'],
                'product_quantity' => $_POST['quantity'],
                
            ];
            
            // Kiểm tra đăng nhập
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['old_url'] = '/product/' . $data['product_id'];
                // Nếu chưa đăng nhập, chuyển hướng sang trang login
                redirect('/login');
                exit;
            }
            // Nếu đã đăng nhập, kiểm tra xem user đã có cart chưa
            $user_id = $_SESSION['user_id'];
            $cart = Cart::where('user_id',$user_id);
            
            if(!$cart){
                $cart = $this->createCart($user_id);
                $_SESSION['cart_id'] = $cart->id;
            
                
            }
            
            // Kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
            $product = Product::findById($data['product_id']);
            $data['cart_id'] = $cart->id;
            $cartDetail = CartDetail::findByCartIdProductId($data['cart_id'],$product->id);
                
            if ($cartDetail) {
                // Nếu đã có cart detail, cập nhật số lượng sản phẩm
                $cartDetail->product_quantity += $data['product_quantity'];
                $cartDetail->save();
                // if ($product === null) {
                //     render_view('error', ['message' => 'Product is null']);
                // } else {
                //     $cartDetail->product_id = $data['product_id'];
                //     $cartDetail->product_quantity = $data['product_quantity'];
                //     $cartDetail->product_id = $data['product_price'];
                //     if ($cartDetail->save()) {
                //         $_SESSION['cart_total'] += $data['product_quantity'];
                //     } else {
                //         render_view('error', ['message' => 'Failed to update cart detail']);
                //     }
                // }
                
            } else {
                $data = [
                    'cart_id' => $data['cart_id'],
                    'product_id' => $data['product_id'],
                    'product_quantity' => $data['product_quantity'],
                ];
                // Nếu chưa có cart detail, tạo mới
                $cartDetail = new CartDetail($data);
                $cartDetail->save();
                $_SESSION['cart_total'] += $data['product_quantity'];
                
                
                // if ($cartDetail->save()) {
                //     $_SESSION['cart_total'] += $data['product_quantity'];
                // } else {
                //     render_view('error', ['message' => 'Failed to add cart detail']);
                // }
            }
        
            
            redirect('/');
        
    }
    public function updateqty()
    {
        $id = $_POST['id'];
    }
    public function createCart($user_id)
    {
        $cart = new Cart(['user_id' => $user_id]);
        $cart->save();
        $_SESSION['cart_total'] = 0;
        return $cart;
    }

    public function updateCart($id, $data)
    {
        $cart = Cart::findById($id);
        if ($cart) {
            $cart->fill($data);
            $cart->save();
        }   
    }

    public function deleteCart($id)
    {
        $cart = Cart::findById($id);
        if ($cart) {
            if ($cart->delete()) {
                $_SESSION['cart_total'] = 0;
                redirect('/');
            } else {
                render_view('error', ['message' => 'Failed to delete cart']);
            }
        } else {
            render_view('error', ['message' => 'Cart not found']);
        }
    }

    public function createCartDetail($data)
    {
        $cartDetail = new CartDetail($data);
        $_SESSION['cart_total'] += 1;
        $cartDetail->save();
        return $cartDetail;
    }

    public function updateCartDetail($id, $data)
    {
        $cartDetail = CartDetail::findById($id);
        if ($cartDetail) {
            $cartDetail->fill($data);
            if ($cartDetail->save()) {
                $_SESSION['cart_total'] += $cartDetail->product_quantity;
            } else {
                render_view('error', ['message' => 'Failed to update cart detail']);
            }
        } else {
            render_view('error', ['message' => 'Cart detail not found']);
        }
        return $cartDetail;
    }

    public function deleteCartDetail($id)
    {
        $cartDetail = CartDetail::findById($id);
        if ($cartDetail) {
            $cartId = $cartDetail->cart_id;
            if ($cartDetail->delete()) {
                $_SESSION['cart_total'] -= $cartDetail->product_quantity;
            } else {
                render_view('error', ['message' => 'Failed to delete cart detail']);
            }
        } else {
            render_view('error', ['message' => 'Cart detail not found']);
        }
    }

    

}
