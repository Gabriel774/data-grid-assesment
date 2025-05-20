<?php

namespace App\Repositories;

use App\Filters\FilterPipeline;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
    protected array $queryFilters = [];

    protected Model $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    abstract protected static function getModel(): Model;
    abstract protected static function getAdditionalFilters(): array;

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

    public function paginate(int $perPage = 15, int $page = 1): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        $filterPipeline = $this->getFilterpipeline();

        return $filterPipeline
            ->applyTo($query)
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function setQueryFilters(array $queryFilters): static
    {
        $this->queryFilters = $queryFilters;

        return $this;
    }

    protected function getFilterpipeline(): FilterPipeline
    {
        return new FilterPipeline(...array_merge($this->queryFilters, $this->getAdditionalFilters()));
    }
}
