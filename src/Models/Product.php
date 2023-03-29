<?php 
 namespace App\Models;

 class Product
 {
    public int $id = -1;
    public string $image;
    public string $name;
    public string $description;
    public int $price;
    public int $quantity;
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
            $query = PDO()->prepare('update products set image = :image, name = :name, description = :description,
            price = :price, quantity = :quantity, category = :category where id = :id');
        
            $result = $query->execute([
                'id' => $this->id,
                'image' => $this->image,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'category' => $this->category
            ]);
        } else {
            $query = PDO()->prepare(
                'insert into products (image, name, description, price, quantity, category)
                values (:image, :name, :description, :price, :quantity, :category)');
            $result = $query->execute([
                    'image' => $this->image,
                    'name' => $this->name,
                    'description' => $this->description,
                    'price' => $this->price,
                    'quantity' => $this->quantity,
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
        $this->image = $row['image'];
        $this->name = $row['name'];
        $this->description = $row['description'];
        $this->price = $row['price'];
        $this->quantity = $row['quantity'];
        $this->category = $row['category'];
        return $this;
    }

    public function fill(array $data)
    {
        $this->image = $data['image'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->price = $data['price'] ?? 0;
        $this->quantity = $data['quantity'] ?? 0;
        $this->category = $data['category'] ?? 0;
        return $this;
    }
    public static function where(string $column, $value): array
    {
        $users = [];
        $query = PDO()->prepare("select * from products where $column = :value");
        $query->execute(['value' => $value]);
        while($row = $query->fetch()) {
            $user = new Product();
            $user->fillFromDb($row);
            $users[] = $user;
        }
        return $users;
    }
    public static function auth(){
        $product_id = $_SESSION['product_id'] ?? null;
        $product = null;
        
        if ($product_id) {
            $product = Product::findById($product_id);
        }
        return $product;
    }
 }