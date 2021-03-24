<?php

namespace App\Repositories;

interface RepositoryInterface
{


    public function getAll();

    public function find($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);

    public function max($val);

    public function getDataWithPagination($qty);

    public function fill($data);

    public function save();
}
