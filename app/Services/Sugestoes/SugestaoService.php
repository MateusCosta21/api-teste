<?php

namespace App\Services\Sugestoes;

use App\Repositories\MusicaRepository;
use App\Repositories\SugestaoRepository;
use App\Services\Sugestoes\Dto\ListaSugestoesDto;
use App\Services\Youtube\YoutubeService;
use Exception;
use Illuminate\Support\Facades\DB;

class SugestaoService
{
    public function __construct(
        protected SugestaoRepository $sugestaoRepository,
        protected YoutubeService $youTubeService,
        protected MusicaRepository $musicaRepository
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

    public function updateStatus(string $id, array $dados)
    {
        DB::beginTransaction(); 
    
        try {
            $sugestao = $this->sugestaoRepository->getById($id);
            if (!$sugestao) {
                throw new Exception("Sugestão não encontrada."); 
            }
    
            $sugestaoAtualizada = $this->sugestaoRepository->update($sugestao->id, $dados);
    
            if ($dados['status'] === 'approved') {
                $this->musicaRepository->salvar([
                    'titulo' => $sugestao->titulo,
                    'youtube_id' => $sugestao->youtube_id,
                    'thumb' => $sugestao->thumb,
                    'visualizacoes' => $sugestao->visualizacoes,
                ]);
            }
    
            DB::commit();
    
            return $sugestaoAtualizada; 
        } catch (Exception $e) {
            DB::rollBack(); 
            throw new Exception("Erro ao atualizar o status e criar a música: " . $e->getMessage()); 
        }
    }
}
