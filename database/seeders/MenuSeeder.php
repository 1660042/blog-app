<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu();
        $menu->insert([
            [
                'name' => 'Bài viết',
                'level' => '1',
                'parent_id' => null,
                'number' => '1',
                'url_page' => 'posts'
            ],
            [
                'name' => 'Tài khoản',
                'level' => '1',
                'parent_id' => null,
                'number' => '2',
                'url_page' => 'accounts'
            ],
            [
                'name' => 'Chuyên mục',
                'level' => '2',
                'parent_id' => 1,
                'number' => '3',
                'url_page' => 'categories.index'
            ],
            [
                'name' => 'Danh sách bài viết',
                'level' => '2',
                'parent_id' => 1,
                'number' => '4',
                'url_page' => 'posts.index'
            ],
            [
                'name' => 'Viết bài mới',
                'level' => '2',
                'parent_id' => 1,
                'number' => '5',
                'url_page' => 'posts.create'
            ],
            [
                'name' => 'Danh sách thành viên',
                'level' => '2',
                'parent_id' => 2,
                'number' => '6',
                'url_page' => 'users'
            ]
        ]);
    }
}
