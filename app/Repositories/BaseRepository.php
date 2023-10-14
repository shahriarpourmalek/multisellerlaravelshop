<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    protected function __construct(string $model)
    {
        $this->model = resolve($model);
    }

    /**
     * Display a listing of the resource
     *
     * @return Collection
     */
    public function list(array $filters)
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of the resource
     *
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate(array $data)
    {
        return $this->model->paginate($data['per_page'] ?? 15);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param array $with
     * @return mixed
     */
    public function findById(int $id, array $with = [])
    {
        return $this->model->with($with)->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $data
     * @param int $id
     */
    public function update(int $id, array $data)
    {
        return $this->findById($id)->update($data);
    }

    /**
     * Count Of resource in storage.
     *
     * @return int
     */
    public function count()
    {
        return $this->model::count();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getModel(): mixed
    {
        return $this->model;
    }
}
