<?php

namespace App\Services\Youtube;

use Illuminate\Support\Facades\Http;
use Exception;

class YoutubeService
{
    public function extractVideoId(string $url): ?string
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }

    public function getVideoInfo(string $youtubeId): array
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
}
