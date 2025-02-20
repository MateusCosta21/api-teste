<?php

namespace App\Http\Controllers;

use App\Services\Musicas\MusicaService;
use Illuminate\Http\Request;

class MusicasController extends Controller
{

    public function __construct(protected MusicaService $service){}

    public function index()
    {
        
        return response()->json($this->service->listarTop5());
    }
}
