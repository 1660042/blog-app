<?php
namespace App\Repositories;

interface RepositoryInterface {

    public function getAll();
    public function getAllWithParam($key, $value);
    public function getAllActive();
    public function find($id);
    //public function findWithParam($id, $key, $value);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
    public function max($val);
    public function getDataWithPagination($qty);

    public function fill($data);

    public function save();
}