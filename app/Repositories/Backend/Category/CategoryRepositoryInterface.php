<?php 

namespace App\Repositories\Backend\Category;

interface CategoryRepositoryInterface {

    
    public function getModel();

    public function getCategory($level);

    public function getCategoryCon();



    // public function getCategoryHD();

    // public function countCategoryConHD($id);

    // public function getCategoryChaHD($id);

    // public function getTablePivot($idQuyen, $idCategory);

    // public function getCategoryByRouteName($routeName);
}