<?php

namespace App\Services\Musicas\Dto;

class ListaMusicasDto
{
    public function __construct(
        public string $filter = '',
        public string $sort_column = '',
        public string $sort_direction = 'desc',
        public int $page = 1,
        public int $limit = 10,
    ) {}
}
