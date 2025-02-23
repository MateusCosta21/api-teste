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
                'youtube_id' => 'mv7IFnlRldQ&',
                'thumb' => 'https://i.ytimg.com/vi/mv7IFnlRldQ/hq720.jpg?sqp=-oaymwFBCNAFEJQDSFryq4qpAzMIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB8AEB-AH-CYAC0AWKAgwIABABGHIgRyhJMA8=&rs=AOn4CLARoVqBH4q3rD-f6VhBaZU7yCJdhw',
                'visualizacoes' => 1500000,
                'created_at' => $now
            ],
            [
                'titulo' => 'Só Não Divulga',
                'youtube_id' => 'qIMlrNuPvsw&',
                'thumb' => 'https://i.ytimg.com/vi/qIMlrNuPvsw/hq720.jpg?sqp=-oaymwEnCNAFEJQDSFryq4qpAxkIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB&rs=AOn4CLBui337f9zIVWADZ5EJdy-q0kxF5g',
                'visualizacoes' => 2000000,
                'created_at' => $now
            ],
            [
                'titulo' => 'Proteção de Tela',
                'youtube_id' => 'edjih_b_NBQ&',
                'thumb' => 'https://i.ytimg.com/vi/edjih_b_NBQ/hq720.jpg?sqp=-oaymwEnCNAFEJQDSFryq4qpAxkIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB&rs=AOn4CLCf2Sq8bTlvcBjWpFAAK01sYR5C0Q',
                'visualizacoes' => 1800000,
                'created_at' => $now
            ],
            [
                'titulo' => 'Rolê',
                'youtube_id' => 'fh9abxybdfc&',
                'thumb' => 'https://i.ytimg.com/vi/fh9abxybdfc/hq720.jpg?sqp=-oaymwEnCNAFEJQDSFryq4qpAxkIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB&rs=AOn4CLDHpTlc9ZX1aGkOewLINXKVVX-aOg',
                'visualizacoes' => 2200000,
                'created_at' => $now
            ],
            [
                'titulo' => 'Nêga',
                'youtube_id' => 'hm-rLEoAi0I&',
                'thumb' => 'https://i.ytimg.com/vi/hm-rLEoAi0I/hq720.jpg?sqp=-oaymwEnCNAFEJQDSFryq4qpAxkIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB&rs=AOn4CLBhR2M3yIYbZ-HwfrH6frmwoP9dpw',
                'visualizacoes' => 2500000,
                'created_at' => $now
            ]
        ]);
    }
}
