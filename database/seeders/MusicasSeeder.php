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
                'thumb' => 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQ4qykpNXu7XUWJfhh2nZnkGt4-SlNHQqnLIFgsEyaVSHr6z8JZ0_gWosPDhGOGePfEDynW0LOX0FRIpCkW49_7jA',
                'visualizacoes' => 1500000,
                'created_at' => $now
            ],
            [
                'titulo' => 'Só Não Divulga',
                'youtube_id' => 'X9UMMOuq8xY',
                'thumb' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBJbnFQaw2wI0pK3GQE_0VpZLIslcwHaTGew&s',
                'visualizacoes' => 2000000,
                'created_at' => $now
            ],
            [
                'titulo' => 'Proteção de Tela',
                'youtube_id' => 'qvRyknEpwcY',
                'thumb' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRWZvdmp67Zh_ECDNtH8h5YGzdUUl96l08KPQ&s',
                'visualizacoes' => 1800000,
                'created_at' => $now
            ],
            [
                'titulo' => 'Rolê',
                'youtube_id' => 'ykUqTgeBMxc',
                'thumb' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS8XX2NwPFjPNyFWwJtemeb1MGsyg1m0t1TFA&s',
                'visualizacoes' => 2200000,
                'created_at' => $now
            ],
            [
                'titulo' => 'Chora Não Bebê',
                'youtube_id' => 'vOqfWlZWxK0',
                'thumb' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS8Y0Zvkrrk8oi-u5ruJEy8Nzh5SelNnA5a_A&s',
                'visualizacoes' => 2500000,
                'created_at' => $now
            ]
        ]);
    }
}
