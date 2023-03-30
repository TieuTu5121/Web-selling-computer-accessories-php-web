<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;

class CartController extends BaseController
{   
    
    public function showCartDetail(){
    }
    public function addCart()
    {
            // Lấy dữ liệu từ form
            $data = [
                'product_id' => $_POST['product_id'],
                'product_quantity' => $_POST['quantity']
            ];
            
            // Kiểm tra đăng nhập
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['old_url'] = '/product/' . $data['product_id'];
                // Nếu chưa đăng nhập, chuyển hướng sang trang login
                redirect('/login');
                exit;
            }
            $product = Product::findById($data['product_id']);
            // Nếu đã đăng nhập, kiểm tra xem user đã có cart chưa
            $user_id = $_SESSION['user_id'];
            $cart = Cart::where('user_id',$user_id);
            if(!$cart){
                $cart = $this->createCart($user_id);
                $_SESSION['cart_id'] = $cart->id;
            }
            // Kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
            
            $cartDetailOld = CartDetail::findByCartIdProductId($cart->id,$data['product_id']);
            $data['cart_id'] = $cart->id;
            $data['product'] = $product;
            
            if ($cartDetailOld) {
                // Nếu đã có cart detail, cập nhật số lượng sản phẩm
                $cartDetailOld->product_quantity += $data['product_quantity'];
                $cartDetailOld->product = $product;
                if ($cartDetailOld->save()) {
                    $_SESSION['cart_total'] += $data['product_quantity'];
                } else {
                    render_view('error', ['message' => 'Failed to update cart detail']);
                } 
            } else {
                // Nếu chưa có cart detail, tạo mới
                if ($product === null) {
                    render_view('error', ['message' => 'Product is null']);
                } else {
                    $cartDetail = new CartDetail($data);
                    if ($cartDetail->save()) {
                        $_SESSION['cart_total'] += $data['product_quantity'];
                    } else {
                        render_view('error', ['message' => 'Failed to add cart detail']);
                    }
                }
            }
            
            redirect('/');
        
    }
    public function createCart($userId)
    {
        $cart = new Cart(['user_id' => $userId]);
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

    public function createCartDetail($cartId, $data)
    {
        $cartDetail = new CartDetail($data);
        $cartDetail->cart_id = $cartId;
        if ($cartDetail->save()) {
            $_SESSION['cart_total'] = $cartDetail->product_quantity;
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
