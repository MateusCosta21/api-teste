<?php

namespace App\Repositories;

use App\Models\Sugestao;

class SugestaoRepository
{

    public function listarPendentes()
    {
        return Sugestao::where('status', 'pendente')->get();
    }

    public function salvar(array $dados)
    {
        return Sugestao::create($dados);
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
