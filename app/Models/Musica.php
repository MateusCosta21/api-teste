<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musica extends Model
{
    use HasFactory;

    protected $table = 'musicas';

    protected $fillable = [
        'titulo',
        'youtube_id',
        'thumb',
        'visualizacoes',
        'approved',
    ];

    protected $casts = [
        'approved' => 'boolean',
    ];

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }
}
