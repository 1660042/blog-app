<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new user();
        $user->insert([
            [
                'name' => 'Bảo Lương',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456')
            ]
            
        ]);
    }
}
