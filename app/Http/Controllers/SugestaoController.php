<?php

namespace App\Http\Controllers;

use App\Models\Sugestao;
use App\Services\Sugestoes\SugestaoService;
use Illuminate\Http\Request;

class SugestaoController extends Controller
{
    public function __construct(protected SugestaoService $sugestaoService) {}

    public function sugerir(Request $request)
    {
        $dados = $request->validate([
            'url' => 'required|url',
        ]);

        $dados['user_id'] = auth('api')->user()->id;

        return response()->json($this->sugestaoService->sugerirMusica($dados), 201);
    }

    public function aprovar(Sugestao $sugestao)
    {
        return response()->json($this->sugestaoService->aprovarSugestao($sugestao));
    }

    public function rejeitar(Sugestao $sugestao)
    {
        return response()->json($this->sugestaoService->rejeitarSugestao($sugestao));
    }
}
