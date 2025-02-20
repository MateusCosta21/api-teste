<?php

namespace App\Http\Controllers;

use App\Http\Resources\SugestoesResource;
use App\Models\Sugestao;
use App\Services\Sugestoes\Dto\ListaSugestoesDto;
use App\Services\Sugestoes\SugestaoService;
use Illuminate\Http\Request;

class SugestaoController extends Controller
{
    public function __construct(protected SugestaoService $sugestaoService) {}


    public function listarPendentes(Request $request)
    {
        $inputDto = new ListaSugestoesDto(
            filter: $request->get('filter', ''),
            sort_column: $request->get('sort_column', 'name'),
            sort_direction: $request->get('sort_direction', 'DESC'),
            page: (int) $request->get('page', 1),
            limit: (int) $request->get('limit', 15),
        );

        $paginatedFolders = $this->sugestaoService->listarSugestoes(dto: $inputDto);
        $paginatedFolders->appends(request()->query());

        return SugestoesResource::collection($paginatedFolders);
    }

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
