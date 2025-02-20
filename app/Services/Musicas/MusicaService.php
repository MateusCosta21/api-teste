<?php

namespace App\Services\Musicas;

use App\Repositories\MusicaRepository;
use App\Repositories\SugestaoRepository;
use Illuminate\Support\Facades\Auth;

class MusicaService
{
    public function __construct(protected MusicaRepository $musicaRepository, protected SugestaoRepository $sugestaoRepository){}
    
    public function getTop5()
    {
        return $this->musicaRepository->getTop5();
    }

    public function suggestMusic($data)
    {
        if (!Auth::check()) {
            throw new \Exception("Usuário não autenticado");
        }

        return $this->sugestaoRepository->criarSugestao($data);
    }
}
