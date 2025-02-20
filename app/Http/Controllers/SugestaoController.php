<?php

namespace App\Http\Controllers;

use App\Services\Sugestoes\SugestaoService;
use Illuminate\Http\Request;

class SugestaoController extends Controller
{

    public function __construct(protected SugestaoService $sugestaoService) {}

    public function sugerir(Request $request, SugestaoService $sugestaoService)
    {
        $dados = $request->validate([
            'url' => 'required|url',
        ]);

        $dados['user_id'] = auth('api')->user()->id;

        return response()->json($sugestaoService->sugerirMusica($dados), 201);
    }
}
