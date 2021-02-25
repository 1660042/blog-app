<?php
namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface {
    protected $_model;

    public function __construct() {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel() {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    public function getAll() {
        return $this->_model->all();
    }

    public function getAllWithParam($key, $value) {
        return $this->_model->where([
            [$key, '=', $value],
            // ['status', '=', 1],
            // ['view', '=', 1]
        ])->get();
    }

    public function find($id) {
        $result = $this->_model->find($id);
        return $result;
    }

    public function max($val) {
        return $this->_model->max($val);
    }

    public function findWithParam($id, $key, $value) {
        $result = $this->_model->where([
            [$key, '=', $value],
            ['id', '=', $id]
        ])->get();
        return $result;
    }

    public function fill($data) {
        return $this->_model->fill($data);
    }

    public function save() {
        return $this->_model->save();
    }

    public function create(array $attributes) {

        return $this->_model->create($attributes);
    }

    public function update($id, array $attributes) {
        $result = $this->find($id);
        if($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    public function delete($id) {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}