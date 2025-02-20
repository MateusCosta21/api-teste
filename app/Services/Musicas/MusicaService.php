<?php

namespace App\Services\Musicas;

use App\Repositories\MusicaRepository;
use App\Services\Musicas\Dto\ListaMusicasDto;
use App\Services\Youtube\YoutubeService;
use Exception;
use Illuminate\Support\Facades\DB;



class MusicaService
{
    public function __construct(
        protected MusicaRepository $musicaRepository,
        protected YoutubeService $youTubeService
    ) {}

    public function listarMusicas(ListaMusicasDto $dto)
    {
        return $this->musicaRepository->getPaginate(dto: $dto);
    }

    public function salvarMusica(array $dados)
    {
        $youtubeId = $this->youTubeService->extractVideoId($dados['url']);
    
        if (!$youtubeId) {
            throw new Exception("URL do YouTube inválida");
        }
    
        $videoInfo = $this->youTubeService->getVideoInfo($youtubeId);

        return $this->musicaRepository->salvar($videoInfo);
    }


    public function atualizarMusica(string $id, array $dados)
    {
        DB::beginTransaction();

        $musica = $this->musicaRepository->getById($id);

        if (! $musica) {
            throw new Exception("Id Inválido");
        }
        DB::commit();

        $youtubeId = $this->youTubeService->extractVideoId($dados['url']);
    
        if (!$youtubeId) {
            throw new Exception("URL do YouTube inválida");
        }
    
        $videoInfo = $this->youTubeService->getVideoInfo($youtubeId);

        return $this->musicaRepository->atualizar($id, $videoInfo);
    }

    public function excluirMusica($musica)
    {
        return $this->musicaRepository->deletar($musica);
    }
}
