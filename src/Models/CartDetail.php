<?php
namespace App\Models;

class CartDetail
{
    public int $id = -1;
    public int $cart_id;
    public Product $product;
    public int $product_quantity = 0;



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
                product_quantity = :product_quantity where id = :id');
            $result = $query->execute([
                'id' => $this->id,
                'cart_id' => $this->cart_id,
                'product_id' => $this->product->id,
                'product_quantity' => $this->product_quantity,
            ]);
        } else {
            $query = PDO()->prepare(
                'insert into cart_detail (cart_id, product_id, product_quantity) 
                values (:cart_id, :product_id, :product_quantity)');
            $result = $query->execute([
                'cart_id' => $this->cart_id,
                'product_id' => $this->product->id,
                'product_quantity' => $this->product_quantity,
            ]);
            if ($result) {
                $this->id = PDO()->lastInsertId();
            }
        }
        return $result;
    }
    public function updateQuantity($quantity)
    {
        $id = $this->id;
        $query =  PDO()->prepare('UPDATE cart_detail SET product_quantity = ? WHERE id = ?');
        return $query->execute(['id' => $id,'product_quantity'=>$quantity]);
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
        $this->product = Product::findById($row['product_id']);
        $this->product_quantity = $row['product_quantity'];
        return $this;
    }
    public function fill(array $data)
    {
        $this->cart_id = $data['cart_id'] ?? -1;
        $this->product = $data['product'] ?? null;
        $this->product_quantity = $data['product_quantity'] ?? 0;
        return $this;
    }

    public static function where(string $column, $value)
    {
        
        $query = PDO()->prepare("select * from cart_detail where $column = :value");
        $query->execute(['value' => $value]);
        if ($row = $query->fetch()) {
            $cartDetail = new CartDetail();
            $cartDetail->fillFromDb($row);
            return $cartDetail;
        }
        return null;
    }
    public static function findByCartIdProductId(int $cartId, int $productId)
{
    $query = PDO()->prepare('select * from cart_detail where cart_id = :cart_id and product_id = :product_id');
    $query->execute([
        'cart_id' => $cartId,
        'product_id' => $productId
    ]);
    if ($row = $query->fetch()) {
        $cartDetail = new CartDetail();
        $cartDetail->fillFromDb($row);
        return $cartDetail;
    }
    return null;
}
}
