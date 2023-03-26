<?php

namespace App\Controllers;

use App\Models\CartDetail;

class CartDetailController
{
    public function index($cartId)
    {
        $cartDetails = CartDetail::findByCartId($cartId);
        render_view('cart_detail', [
            'cartDetails' => $cartDetails,
            'cartId' => $cartId,
        ]);
    }

    public function store($cartId, $data)
    {
        $cartDetail = new CartDetail($data);
        $cartDetail->cart_id = $cartId;
        if ($cartDetail->save()) {
            header("Location: /cart/{$cartId}/detail");
        } else {
            render_view('error', ['message' => 'Failed to create cart detail']);
        }
    }

    public function update($id, $data)
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

    public function destroy($id)
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
}
