<?php

namespace App\Services\Musicas;

use App\Repositories\MusicaRepository;
use App\Services\Musicas\Dto\ListaMusicasDto;


class MusicaService
{
    public function __construct(protected MusicaRepository $musicaRepository){}
    
    public function listarMusicas(ListaMusicasDto $dto)
    {
        return $this->musicaRepository->getPaginate(dto: $dto);
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
