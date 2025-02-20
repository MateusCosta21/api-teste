<?php

namespace App\Http\Controllers;

use App\Services\Sugestoes\SugestaoService;
use Illuminate\Http\Request;

class SugestaoController extends Controller
{

    public function __construct(protected SugestaoService $sugestaoService){}

    public function sugerir(Request $request)
    {
        $dados = $request->validate(['youtube_id' => 'required|string']);
        return response()->json($this->sugestaoService->sugerirMusica($dados));
    }
}
