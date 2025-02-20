<?php

namespace App\Http\Controllers;

use App\Services\Musicas\MusicaService;
use Illuminate\Http\Request;

class MusicasController extends Controller
{

    public function __construct(protected MusicaService $service){}

    public function index()
    {
        return response()->json($this->service->getTop5(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'url' => 'required|url',
        ]);

        return response()->json($this->service->suggestMusic($data), 201);
    }
}
