<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Role();
        $post->insert([
            [
                'code' => 'Member',
                'name' => 'Thành viên',
                'description' => 'Quyền mặc định dành cho thành viên',
                'status' => '1',
                'created_by' => '1',
                'updated_by' => '1'
            ],

        ]);
    }
}
