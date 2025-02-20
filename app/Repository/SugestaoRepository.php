<?php

namespace App\Repositories;

use App\Models\Sugestao;

class SugestaoRepository
{

    public function __construct(protected Sugestao $model){}

    public function criarSugestao($data)
    {
        return $this->model->create($data);
    }
    
}