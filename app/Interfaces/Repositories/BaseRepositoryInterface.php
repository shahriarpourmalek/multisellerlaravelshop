<?php

namespace App\Interfaces\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{

    /**
     * Display a listing of the resource
     *
     * @param array $filters
     * @return Collection
     */
    public function list(array $filters);

    /**
     * Display a paginated listing of the resource
     *
     * @param array $filters
     * @return Illuminate
     */
    public function paginate(array $filters);

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param array $with
     */
    public function findById(int $id, array $with = []);

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * @return Model
     */
    public function store(array $data);

    /**
     * Update the specified resource in storage.
     *
     * @param array $data
     * @param int $id
     */
    public function update(int $id, array $data);


    /**
     * Display a Count of the resource
     *
     * @return int
     */
    public function count();
    public function getModel();
}
