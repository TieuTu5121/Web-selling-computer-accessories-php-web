<?php 
 namespace App\Models;

 class Product
 {
    public int $id = -1;
    public string $name;
    public string $description;
    public int $price;
    public string $category;
    public function __construct(array $data = [])
    {
        $this->fill($data);
    }
    public static function all(): array
    {
        $products = [];
        $query = PDO()->prepare('select * from products');
        $query->execute();
        while($row = $query->fetch()) {
            $product = new Product();
            $product->fillFromDb($row);
            $products[] = $product;
        }
        return $products;
    }
    public function save() 
    {
        $result = false;
        if($this->id >=0) {
            $query = PDO()->prepare('update products set name = :name, description = :description,
            price = :price, category = :category where id = :id');
        
            $result = $query->execute([
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'category' => $this->category
            ]);
        } else {
            $query = PDO()->prepare(
                'insert into products (name, description, price, category)
                values (:name, :description, :price, :category)');
            $result = $query->execute([
                    'name' => $this->name,
                    'description' => $this->description,
                    'price' => $this->price,
                    'category' => $this->category
            ]);
            if ($result) {
                $this->id = PDO()->lastInsertId();
            }
        }
        return $result;
    }

    public function delete() 
    {
        $query = PDO()->prepare('delete from products where id = :id');
        return $query->execute(['id' => $this->id]);
    }
    public static function findById(int $id)
    {
        $query = PDO()->prepare('select * from products where id = :id');
        $query->execute(['id' => $id]);
        if ($row = $query->fetch()) {
            $product = new Product();
            $product->fillFromDb($row);
            return $product;
        }
        return null;
    }
    protected function fillFromDb(array $row)
    {
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->description = $row['description'];
        $this->price = $row['price'];
        $this->category = $row['category'];
        return $this;
    }

    public function fill(array $data)
    {
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->price = $data['price'] ?? 0;
        $this->category = $data['category'] ?? 0;
        return $this;
    }
 }