<?php

namespace App\Repositories;

use App\Models\Sugestao;

class SugestaoRepository
{


    public function __construct(protected Sugestao $model){}
    
    public function listarPendentes()
    {
        return $this->model->where('status', 'pendente')->get();
    }

    public function salvar(array $dados)
    {
        return $this->model->create($dados);
    }

    public function aprovar(Sugestao $sugestao)
    {
        $sugestao->update(['status' => 'aprovada']);
        return $sugestao;
    }

    public function rejeitar(Sugestao $sugestao)
    {
        $sugestao->update(['status' => 'rejeitada']);
        return $sugestao;
    }
}
