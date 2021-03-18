<?php

namespace App\Http\Views\Composers;

use App\Repositories\Backend\Category\CategoryRepositoryInterface;
use App\Repositories\Backend\Category\CategoryRepository;

use Illuminate\View\View;

class CategoryComposer
{

    protected $cat;

    public function __construct()
    {
        // Dependencies are automatically resolved by the service container...
        $this->cat = new CategoryRepository();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = $this->cat->getCategoryMain();

        // foreach($categories as $cat) {
        //     if($cat->parent_id == null) {
        //         dd($cat->getChildCategories);
        //     }
        // }

		// $childCategories = $this->cat->getAllChildCategoriesActive();
        // if($categories->getChildCategories == null) {
        //     dd('check');
        // }
        //dd($childCategories);

		$data = compact('categories');
		$view->with($data);
    }
}