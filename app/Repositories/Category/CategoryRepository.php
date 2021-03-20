<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\Category::class;
    }

    public function getCategory($level)
    {
        return $this->_model->whereNull('parent_id')->orderByRaw('number')->get();
    }

    public function getCategoryMain()
    {
        return $this->_model
            ->whereNull('parent_id')
            ->where([
                ['level', '=', '1'],
                ['status', '=', '1'],
            ])->orderBy('number')->get();
    }

    public function getCategoryMainWithParam($id)
    {
        return $this->_model
            ->whereNull('parent_id')
            ->where([
                ['level', '=', '1'],
                ['status', '=', '1'],
                ['id', '!=', $id]
            ])->orderBy('number')->get();
    }

    public function getChildCategories($id)
    {
        return $this->_model
            ->whereNotNull('parent_id')
            ->where([
                ['parent_id', '=', $id]
            ])->get();
    }

    public function getAllChildCategoriesActive()
    {
        return $this->_model
            ->whereNotNull('parent_id')
            ->where([
                ['status', '=', '1']
            ])->get();
    }

    public function getCategoryActive($key, $value)
    {
        return $this->_model->where([
            [$key, '=', $value],
            ['status', '=', '1']
        ])->first();
    }
}
