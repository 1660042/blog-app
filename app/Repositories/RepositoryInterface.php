<?php
namespace App\Repositories;

interface RepositoryInterface {

    public function getAll();
    public function getAllWithParam($key, $value);
    public function find($id);
    public function findWithParam($id, $key, $value);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
}