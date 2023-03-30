<?php

namespace App\Models;

class Cart
{
    public int $id = -1;
    public int $user_id;

    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    public static function all(): array
    {
        $carts = [];
        $query = PDO()->prepare('select * from carts');
        $query->execute();
        while($row = $query->fetch()) {
            $cart = new Cart();
            $cart->fillFromDb($row);
            $carts[] = $cart;
        }
        return $carts;
    }


    public function save()
    {
        $result = false;
        if($this->id >= 0) {
            $query = PDO()->prepare('update carts set user_id = :user_id where id = :id');

            $result = $query->execute([
                'id' => $this->id,
                'user_id' => $this->user_id,
            ]);
        } else {
            $query = PDO()->prepare(
                'insert into carts (user_id)
                values (:user_id)');
            $result = $query->execute([
                'user_id' => $this->user_id,
            ]);
            if ($result) {
                $this->id = PDO()->lastInsertId();
            }
        }
        return $result;
    }

    public function delete()
    {
        $query = PDO()->prepare('delete from carts where id = :id');
        return $query->execute(['id' => $this->id]);
    }

    public static function findById(int $id)
    {
        $query = PDO()->prepare('select * from carts where id = :id');
        $query->execute(['id' => $id]);
        if ($row = $query->fetch()) {
            $cart = new Cart();
            $cart->fillFromDb($row);
            return $cart;
        }
        return null;
    }

    protected function fillFromDb(array $row)
    {
        $this->id = $row['id'];
        $this->user_id = $row['user_id'];
        return $this;
    }

    public function fill(array $data)
    {
        $this->user_id = $data['user_id'] ?? 0;
        return $this;
    }

    public static function where(string $column, $value)
    {
        
        $query = PDO()->prepare("select * from carts where $column = :value");
        $query->execute(['value' => $value]);
        if ($row = $query->fetch()) {
            $cart = new Cart();
            $cart->fillFromDb($row);
            return $cart;
        }
        return null;
    }

    

}
