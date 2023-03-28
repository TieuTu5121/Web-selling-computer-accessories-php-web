<?php

namespace App\Models;

use PDO;

class Model
{
    protected $pdo;
    protected $table;

    public function __construct(PDO $pdo, $table)
    {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    public function where(array $conditions)
    {
        $query = "SELECT * FROM {$this->table} WHERE ";
        $params = [];

        foreach ($conditions as $field => $value) {
            $query .= "{$field} = :{$field} AND ";
            $params[":{$field}"] = $value;
        }

        $query = rtrim($query, ' AND ');

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt;
    }

    public function first()
    {
        $query = "SELECT * FROM {$this->table} LIMIT 1";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function all()
    {
        $query = "SELECT * FROM {$this->table}";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // other methods for insert, update, delete...
}
