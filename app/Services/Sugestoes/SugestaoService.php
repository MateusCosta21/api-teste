<?php

namespace App\Services\Sugestoes;

use App\Repositories\SugestaoRepository;
use App\Services\Sugestoes\Dto\ListaSugestoesDto;
use App\Services\YouTube\YouTubeService;
use Exception;
use Illuminate\Support\Facades\DB;

class SugestaoService
{
    public function __construct(
        protected SugestaoRepository $sugestaoRepository,
        protected YouTubeService $youTubeService
    ) {}

    public function listarSugestoes(ListaSugestoesDto $dto)
    {
        return $this->sugestaoRepository->getPaginate(dto: $dto);
    }

    public function listarPendentes()
    {
        return $this->sugestaoRepository->listarPendentes();
    }

    public function sugerirMusica(array $dados)
    {
        $youtubeId = $this->youTubeService->extractVideoId($dados['url']);
    
        if (!$youtubeId) {
            throw new Exception("URL do YouTube inválida");
        }
    
        $videoInfo = $this->youTubeService->getVideoInfo($youtubeId);
        $videoInfo['user_id'] = $dados['user_id'];
    
        return $this->sugestaoRepository->salvar($videoInfo);
    }

    public function updateStatus(string $id, array $data)
    {
        DB::beginTransaction();

        $sugestao = $this->sugestaoRepository->getById($id);
        if(!$sugestao){
            throw new Exception("O id não existe");
        }

        DB::commit();

        return $this->sugestaoRepository->update($sugestao->id, $data);
    }
}
