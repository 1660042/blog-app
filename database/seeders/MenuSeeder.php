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
                'name_route' => 'posts'
            ],
            [
                'name' => 'Tài khoản',
                'level' => '1',
                'parent_id' => null,
                'number' => '2',
                'name_route' => 'accounts'
            ],
            [
                'name' => 'Chuyên mục',
                'level' => '2',
                'parent_id' => 1,
                'number' => '3',
                'name_route' => 'categories.index'
            ],
            [
                'name' => 'Danh sách bài viết',
                'level' => '2',
                'parent_id' => 1,
                'number' => '4',
                'name_route' => 'posts.index'
            ],
            [
                'name' => 'Viết bài mới',
                'level' => '2',
                'parent_id' => 1,
                'number' => '5',
                'name_route' => 'posts.create'
            ],
            [
                'name' => 'Danh sách thành viên',
                'level' => '2',
                'parent_id' => 2,
                'number' => '6',
                'name_route' => 'accounts.index'
            ],
            [
                'name' => 'Quản trị hệ thống',
                'level' => '1',
                'parent_id' => null,
                'number' => '7',
                'name_route' => 'systems'
            ],
            [
                'name' => 'Danh sách quyền',
                'level' => '2',
                'parent_id' => 7,
                'number' => '8',
                'name_route' => 'roles.index'
            ],
            [
                'name' => 'Cài đặt hệ thống',
                'level' => '2',
                'parent_id' => 7,
                'number' => '9',
                'name_route' => 'settings.index',
            ]
        ]);
    }
}
