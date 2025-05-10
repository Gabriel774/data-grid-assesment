<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    abstract static protected function getModel(): Model;

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $record = $this->find($id);

        $record->update($data);

        return $record;
    }

    public function delete(int $id): void
    {
        $this->find($id)->delete();
    }

    public function paginate(int $perPage = 15, ?int $page = null): LengthAwarePaginator
    {
        $page = $page ?? request()->input('page', 1);

        return $this->model->newQuery()->paginate($perPage, ['*'], 'page', $page);
    }
}
