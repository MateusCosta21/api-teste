<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MusicasSeeder extends Seeder
{
    public function run()
    {

        $now = Carbon::now();

        DB::table('musicas')->insert([
            [
                'titulo' => 'Meia Noite',
                'youtube_id' => '7XWGYh_TwWg',
                'thumb' => 'https://img.youtube.com/vi/7XWGYh_TwWg/hqdefault.jpg',
                'visualizacoes' => 1500000,
                'created_at' => $now
            ],
            [
                'titulo' => 'Só Não Divulga',
                'youtube_id' => 'X9UMMOuq8xY',
                'thumb' => 'https://img.youtube.com/vi/X9UMMOuq8xY/hqdefault.jpg',
                'visualizacoes' => 2000000,
                'created_at' => $now
            ],
            [
                'titulo' => 'Proteção de Tela',
                'youtube_id' => 'qvRyknEpwcY',
                'thumb' => 'https://img.youtube.com/vi/qvRyknEpwcY/hqdefault.jpg',
                'visualizacoes' => 1800000,
                'created_at' => $now
            ],
            [
                'titulo' => 'Rolê',
                'youtube_id' => 'ykUqTgeBMxc',
                'thumb' => 'https://img.youtube.com/vi/ykUqTgeBMxc/hqdefault.jpg',
                'visualizacoes' => 2200000,
                'created_at' => $now
            ],
            [
                'titulo' => 'Chora Não Bebê',
                'youtube_id' => 'vOqfWlZWxK0',
                'thumb' => 'https://img.youtube.com/vi/vOqfWlZWxK0/hqdefault.jpg',
                'visualizacoes' => 2500000,
                'created_at' => $now
            ]
        ]);
    }
}
