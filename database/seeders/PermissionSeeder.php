<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'menu_id' => '3',
                'role_id' => '1',
                'access' => '1',
                'index' => '1',
                'show' => '1',
                'create' => '1',
                'edit' => '1',
                'delete' => '1',
                'censor' => '1',
            ],
            [
                'menu_id' => '4',
                'role_id' => '1',
                'access' => '1',
                'index' => '1',
                'show' => '1',
                'create' => '1',
                'edit' => '1',
                'delete' => '1',
                'censor' => '1',
            ],
            [
                'menu_id' => '6',
                'role_id' => '1',
                'access' => '1',
                'index' => '1',
                'show' => '1',
                'create' => '1',
                'edit' => '1',
                'delete' => '1',
                'censor' => '1',
            ],
            [
                'menu_id' => '8',
                'role_id' => '1',
                'access' => '1',
                'index' => '1',
                'show' => '1',
                'create' => '1',
                'edit' => '1',
                'delete' => '1',
                'censor' => '1',
            ],
        ]);
    }
}
