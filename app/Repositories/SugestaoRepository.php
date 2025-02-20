<?php

namespace App\Repositories;

use App\Models\Sugestao;
use App\Services\Sugestoes\Dto\ListaSugestoesDto;

class SugestaoRepository
{


    public function __construct(protected Sugestao $model){}


    public function getPaginate(ListaSugestoesDto $dto)
    {
        $query = $this->model->query();

        if (! empty($dto->filter)) {
            $query->where('titulo', 'ILIKE', '%'.$dto->filter.'%');
        }

        $sortColumn = $dto->sort_column ?? 'id';
        $sortDirection = $dto->sort_direction ?? 'asc';

        if (in_array($sortColumn, ['id', 'titulo', 'youtube_id', 'visualizacoes', 'created_at', 'updated_at'])) {
            $query->orderBy($sortColumn, $sortDirection);
        }

        $limit = $dto->limit ?? 10;
        $page = $dto->page ?? 1;

        return $query->paginate($limit, ['*'], 'page', $page);
    }

    public function listarPendentes()
    {
        return $this->model->where('status', 'pendente')->get();
    }

    public function salvar(array $dados)
    {
        return $this->model->create($dados);
    }

    public function getById(string $id)
    {
        return $this->model->find($id);
    }

    public function update(string $id, array $dados)
    {
        $this->model->where('id', $id)->update($dados);

        return $this->model->find($id);
    }
}
