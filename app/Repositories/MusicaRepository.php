<?php

namespace App\Repositories;

use App\Services\Musicas\Dto\ListaMusicasDto;

use App\Models\Musica;

class MusicaRepository
{

    public function __construct(protected Musica $model ){}

    public function getPaginate(ListaMusicasDto $dto)
    {
        $query = Musica::query();

        if (! empty($dto->filter)) {
            $query->where('titulo', 'ILIKE', '%'.$dto->filter.'%');
        }

        $sortColumn = $dto->sort_column ?? 'visualizacoes';
        $sortDirection = $dto->sort_direction ?? 'desc';

        if (in_array($sortColumn, ['id', 'titulo', 'visualizacoes', 'created_at', 'updated_at'])) {
            $query->orderBy($sortColumn, $sortDirection);
        }

        $limit = $dto->limit ?? 10;
        $page = $dto->page ?? 1;

        return $query->paginate($limit, ['*'], 'page', $page);
    }

    public function getById(string $id)
    {
        return $this->model->find($id);
    }

    public function salvar(array $dados)
    {
        return $this->model->create($dados);
    }

    public function atualizar(string $id, array $dados)
    {
        $this->model->where('id', $id)->update($dados);
        return $this->model->find($id);
    }
}
