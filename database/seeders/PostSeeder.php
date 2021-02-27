<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class postSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post();
        $post->insert([
            [
                'name' => 'Hello world',
                'slug' => 'hello-world',
                'path_image' => '/hinh-anh-1',
                'content' => 'Bài viết đầu tiên',
                'category_id' => '3',
                'created_by' => '1'
            ],
            [
                'name' => 'Say goodbye',
                'slug' => 'say-google',
                'path_image' => '/hinh-anh-2',
                'content' => 'Bài viết thứ 2',
                'category_id' => '4',
                'created_by' => '1'
            ],
            
        ]);
    }
}