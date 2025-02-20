<?php

namespace App\Repositories;

use App\Models\Musica;

class MusicaRepository
{

    public function __construct(protected Musica $model ){}
    public function getTop5()
    {
        return $this->model->orderBy('visualizacoes', 'desc')->limit(5)->get();
    }

    public function saveMusic($data)
    {
        return $this->model->create($data);
    }
}
