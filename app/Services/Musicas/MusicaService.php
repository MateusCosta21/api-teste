<?php

namespace App\Services\Musicas;

use App\Repositories\MusicaRepository;

class MusicaService
{
    public function __construct(protected MusicaRepository $musicaRepository){}
    
    public function listarTop5()
    {
        return $this->musicaRepository->listar();
    }

    public function salvarMusica(array $dados)
    {
        return $this->musicaRepository->salvar($dados);
    }

    public function excluirMusica($musica)
    {
        return $this->musicaRepository->deletar($musica);
    }
}
