<?php

namespace App\Http\Controllers;

use App\Http\Resources\MusicasResource;
use App\Services\Musicas\Dto\ListaMusicasDto;
use App\Services\Musicas\MusicaService;
use Illuminate\Http\Request;

class MusicasController extends Controller
{

    public function __construct(protected MusicaService $service){}

    public function index(Request $request)
    {
        $inputDto = new ListaMusicasDto(
            filter: $request->get('filter', ''),
            sort_column: $request->get('sort_column', 'visualizacoes'),
            sort_direction: $request->get('sort_direction', 'desc'),
            page: (int) $request->get('page', 1),
            limit: (int) $request->get('limit', 15),
        );

        $musicas = $this->service->listarMusicas(dto: $inputDto);
        $musicas->appends(request()->query());

        return MusicasResource::collection($musicas);
    }
}
