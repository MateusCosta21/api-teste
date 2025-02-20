<?php

namespace App\Services\Sugestoes;

use App\Repositories\SugestaoRepository;

class SugestaoService
{
    protected $sugestaoRepository;

    public function __construct(SugestaoRepository $sugestaoRepository)
    {
        $this->sugestaoRepository = $sugestaoRepository;
    }

    public function listarPendentes()
    {
        return $this->sugestaoRepository->listarPendentes();
    }

    public function sugerirMusica(array $dados)
    {
        return $this->sugestaoRepository->salvar($dados);
    }

    public function aprovarSugestao($sugestao)
    {
        return $this->sugestaoRepository->aprovar($sugestao);
    }

    public function rejeitarSugestao($sugestao)
    {
        return $this->sugestaoRepository->rejeitar($sugestao);
    }
}
