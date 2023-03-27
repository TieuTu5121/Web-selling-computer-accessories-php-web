<?php

namespace App\Models;

class CartDetail
{
    public int $id = -1;
    public int $cart_id;
    public int $product_id = -1;
    public int $product_quantity = 0;
    public int $product_price = 0;

    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    public static function all(): array
    {
        $cartDetails = [];
        $query = PDO()->prepare('select * from cart_detail');
        $query->execute();
        while ($row = $query->fetch()) {
            $cartDetail = new CartDetail();
            $cartDetail->fillFromDb($row);
            $cartDetails[] = $cartDetail;
        }
        return $cartDetails;
    }

    public function save()
    {
        $result = false;
        if ($this->id >= 0) {
            $query = PDO()->prepare('update cart_detail set cart_id = :cart_id, product_id = :product_id, 
                product_quantity = :product_quantity, product_price = :product_price where id = :id');
            $result = $query->execute([
                'id' => $this->id,
                'cart_id' => $this->cart_id,
                'product_id' => $this->product_id,
                'product_quantity' => $this->product_quantity,
                'product_price' => $this->product_price,
            ]);
        } else {
            $query = PDO()->prepare(
                'insert into cart_detail (cart_id, product_id, product_quantity, product_price) 
                values (:cart_id, :product_id, :product_quantity, :product_price)');
            $result = $query->execute([
                'cart_id' => $this->cart_id,
                'product_id' => $this->product_id,
                'product_quantity' => $this->product_quantity,
                'product_price' => $this->product_price,
            ]);
            if ($result) {
                $this->id = PDO()->lastInsertId();
            }
        }
        return $result;
    }

    public function delete()
    {
        $query = PDO()->prepare('delete from cart_detail where id = :id');
        return $query->execute(['id' => $this->id]);
    }

    public static function findById(int $id)
    {
        $query = PDO()->prepare('select * from cart_detail where id = :id');
        $query->execute(['id' => $id]);
        if ($row = $query->fetch()) {
            $cartDetail = new CartDetail();
            $cartDetail->fillFromDb($row);
            return $cartDetail;
        }
        return null;
    }

    protected function fillFromDb(array $row)
    {
        $this->id = $row['id'];
        $this->cart_id = $row['cart_id'];
        $this->product_id = $row['product_id'];
        $this->product_quantity = $row['product_quantity'];
        $this->product_price = $row['product_price'];
        return $this;
    }
    public function fill(array $data)
    {
        $this->cart_id = $data['cart_id'] ?? -1;
        $this->product_id = $data['product_id'] ?? -1;
        $this->product_quantity = $data['product_quantity'] ?? 0;
        $this->product_price = $data['product_price'] ?? 0;
        return $this;
    }
}