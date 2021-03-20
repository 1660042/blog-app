<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = new Comment();
        $comment->insert([
            [
                'name' => 'Comment số 1',
                'email' => 'comment1@gmail.com',
                'website' => 'web1.com',
                'content' => 'comment số 1',
                'answer_comment_id' => null,
                'post_id' => '1'
            ],
            [
                'name' => 'Rep 1',
                'email' => 'rep1@gmail.com',
                'website' => 'rep1.com',
                'content' => 'Trả lời comment số 1',
                'answer_comment_id' => '1',
                'post_id' => '1'
            ],
            [
                'name' => 'Rep 2',
                'email' => 'rep2@gmail.com',
                'website' => 'rep2.com',
                'content' => 'Trả lời comment số 1 lần 2',
                'answer_comment_id' => '1',
                'post_id' => '1'
            ],
            [
                'name' => 'Rep 3',
                'email' => 'rep3@gmail.com',
                'website' => 'rep3.com',
                'content' => 'Trả lời comment số 1 lần 3',
                'answer_comment_id' => '1',
                'post_id' => '1'
            ],
            [
                'name' => 'Comment 2',
                'email' => 'comment2@gmail.com',
                'website' => 'comment2.com',
                'content' => 'Comment2',
                'answer_comment_id' => null,
                'post_id' => '1'
            ],
            [
                'name' => 'Rep 2-1',
                'email' => 'rep2-1@gmail.com',
                'website' => 'rep2-1.com',
                'content' => 'Trả lời comment số 2 lần 1',
                'answer_comment_id' => '5',
                'post_id' => '1'
            ],
            [
                'name' => 'Rep 2-2',
                'email' => 'rep2-2@gmail.com',
                'website' => 'rep2-2.com',
                'content' => 'Trả lời comment số 2 lần 2',
                'answer_comment_id' => '5',
                'post_id' => '1'
            ],
            [
                'name' => 'Rep 2-3',
                'email' => 'rep2-3@gmail.com',
                'website' => 'rep2-3.com',
                'content' => 'Trả lời comment số 2 lần 3',
                'answer_comment_id' => '5',
                'post_id' => '1'
            ],
        ]);
    }
}
