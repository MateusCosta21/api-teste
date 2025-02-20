<?php

namespace App\Repositories;

use App\Models\Musica;

class MusicaRepository
{

    public function __construct(protected Musica $model ){}
    public function listar()
    {
        return $this->model->orderByDesc('visualizacoes')->take(5)->get();
    }

    public function salvar(array $dados)
    {
        return $this->model->create($dados);
    }

    public function deletar(Musica $musica)
    {
        return $musica->delete();
    }
}
