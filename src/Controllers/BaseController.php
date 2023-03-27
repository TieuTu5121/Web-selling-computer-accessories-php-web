<?php

namespace App\Controllers;

use App\Models\Model;

class BaseController
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function where(array $conditions)
    {
        $this->model->where($conditions);
        return $this;
    }

    public function first()
    {
        return $this->model->first();
    }
}
