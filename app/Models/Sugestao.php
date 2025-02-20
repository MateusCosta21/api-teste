<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Sugestao extends Model
{
    use HasFactory;

    protected $table = 'sugestoes';
    protected $fillable = ['user_id', 'titulo', 'youtube_id', 'thumb', 'visualizacoes', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
