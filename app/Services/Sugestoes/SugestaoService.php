<?php

namespace App\Services\Sugestoes;

use App\Repositories\SugestaoRepository;
use App\Services\Sugestoes\Dto\ListaSugestoesDto;
use Exception;
use Illuminate\Support\Facades\Http;

class SugestaoService
{
    protected $sugestaoRepository;

    public function __construct(SugestaoRepository $sugestaoRepository)
    {
        $this->sugestaoRepository = $sugestaoRepository;
    }

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
        $youtubeId = $this->extractVideoId($dados['url']);
    
        if (!$youtubeId) {
            throw new Exception("URL do YouTube inválida");
        }
    
        $videoInfo = $this->getVideoInfo($youtubeId);
    
        $videoInfo['user_id'] = $dados['user_id'];
    
        return $this->sugestaoRepository->salvar($videoInfo);
    }
    

    private function extractVideoId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }
    
    /**
     * Busca informações do vídeo via scraping
     */
    private function getVideoInfo($youtubeId)
    {
        $url = "https://www.youtube.com/watch?v=" . $youtubeId;
    
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0'
        ])->get($url);
    
        if (!$response->successful()) {
            throw new Exception("Erro ao acessar o YouTube");
        }
    
        $html = $response->body();
    
        preg_match('/<title>(.+?) - YouTube<\/title>/', $html, $titleMatches);
        $title = html_entity_decode($titleMatches[1] ?? 'Sem título', ENT_QUOTES);
    
        preg_match('/"viewCount":"(\d+)"/', $html, $viewMatches);
        $views = $viewMatches[1] ?? 0;
    
        return [
            'youtube_id' => $youtubeId,
            'titulo' => $title,
            'visualizacoes' => (int) $views,
            'thumb' => "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg",
        ];
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
