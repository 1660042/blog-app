<?php

namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{


    public function getModel();

    public function getCategory($level);

    public function getCategoryMain();

    public function getCategoryMainWithParam($id);

    public function getChildCategories($id);

    public function getAllChildCategoriesActive();

    public function getCategoryActive($key, $value);
}
