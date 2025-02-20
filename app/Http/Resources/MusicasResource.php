<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MusicasResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'youtube_id' => $this->youtube_id,
            'thumb' => $this->thumb,
            'visualizacoes' => $this->visualizacoes,
        ];
    }
}
