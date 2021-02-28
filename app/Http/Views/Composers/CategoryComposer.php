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

		$childCategories = $this->cat->getAllChildCategoriesActive();

		$data = compact('categories', 'childCategories');
		$view->with($data);
    }
}