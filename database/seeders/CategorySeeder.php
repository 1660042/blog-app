<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->insert([
            [
                'name' => 'Wordpress',
                'level' => '1',
                'parent_id' => null,
                'number' => '1',
                'name_route' => null
            ],
            [
                'name' => 'Thủ thuật',
                'level' => '1',
                'parent_id' => null,
                'number' => '2',
                'name_route' => null
            ],
            [
                'name' => 'Plugins wordpress',
                'level' => '2',
                'parent_id' => 1,
                'number' => '3',
                'name_route' => 'plugins-wordpress'
            ],
            [
                'name' => 'Hướng dẫn wordpress',
                'level' => '2',
                'parent_id' => 1,
                'number' => '4',
                'name_route' => 'huong-dan-wordpress'
            ],
            [
                'name' => 'Facebook',
                'level' => '2',
                'parent_id' => 2,
                'number' => '5',
                'name_route' => 'facebook'
            ],
            [
                'name' => 'Windows',
                'level' => '2',
                'parent_id' => 2,
                'number' => '6',
                'name_route' => 'Windows'
            ]
        ]);
    }
}
