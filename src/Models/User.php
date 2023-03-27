<?php

namespace App\Models;

class User
{
    public int $id = -1;
    public string $name;
    public string $email;
    public string $phone;
    public string $address;
    public string $gender;
    public string $password;

    public function __construct(array $data = [])
    {
        $this->fill($data);
    }

    public static function all(): array
    {
        $users = [];
        $query = PDO()->prepare('select * from users');
        $query->execute();
        while($row = $query->fetch()) {
            $user = new User();
            $user->fillFromDb($row);
            $users[] = $user;
        }
        return $users;
    }
    public function save() 
    {
        $result = false;
        if($this->id >=0) {
            $query = PDO()->prepare('update users set name = :name, email = :email,
            phone = :phone,address = :address,gender = :gender ,password = :password  where id = :id');
        
            // Hash the password
            $hashed_password = md5($this->password);

            $result = $query->execute([
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'gender'  => $this->gender,
                'password' => $hashed_password // Use hashed password
            ]);
        } else {
            $query = PDO()->prepare(
                'insert into users (name, email, phone, address, gender , password)
                            values (:name, :email, :phone, :address, :gender, :password)');

            // Hash the password
            $hashed_password = md5($this->password);

            $result = $query->execute([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'gender' => $this->gender,
                    'password' => $hashed_password // Use hashed password
            ]);
            if ($result) {
                $this->id = PDO()->lastInsertId();
            }
        }
        return $result;
    }

    public function delete() 
    {
        $query = PDO()->prepare('delete from users where id = :id');
        return $query->execute(['id' => $this->id]);
    }
    public static function findById(int $id)
    {
        $query = PDO()->prepare('select * from users where id = :id');
        $query->execute(['id' => $id]);
        if ($row = $query->fetch()) {
            $user = new User();
            $user->fillFromDb($row);
            return $user;
        }
        return null;
    }
    protected function fillFromDb(array $row)
    {
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->phone = $row['phone'];
        $this->address = $row['address'];
        $this->gender = $row['gender'];
        $this->password = $row['password'];
        return $this;
    }
    
    public function fill(array $data)
    {
        $this->name = $data['name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->address = $data['address'] ?? '';
        $this->gender = $data['gender'] ?? '';
        $this->password = $data['password'] ?? '';
        return $this;
    }


}