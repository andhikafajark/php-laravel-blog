<?php

namespace Database\Seeders;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Comment::insert([
            [
                'id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'parent_id' => null,
                'comment' => 'Comment 1',
                'commentable_id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'commentable_type' => 'Modules\Blog\Models\Blog',
                'created_by' => 'e976eba4-6853-4405-9549-a503ab645981',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 'e976eba4-6853-4405-9549-a503ab645982',
                'parent_id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'comment' => 'Comment 1 Reply 1',
                'commentable_id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'commentable_type' => 'Modules\Blog\Models\Blog',
                'created_by' => 'e976eba4-6853-4405-9549-a503ab645981',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 'e976eba4-6853-4405-9549-a503ab645984',
                'parent_id' => 'e976eba4-6853-4405-9549-a503ab645982',
                'comment' => 'Comment 1 Reply 1 Reply 1',
                'commentable_id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'commentable_type' => 'Modules\Blog\Models\Blog',
                'created_by' => 'e976eba4-6853-4405-9549-a503ab645981',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 'e976eba4-6853-4405-9549-a503ab645983',
                'parent_id' => null,
                'comment' => 'Comment 2',
                'commentable_id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'commentable_type' => 'Modules\Blog\Models\Blog',
                'created_by' => 'e976eba4-6853-4405-9549-a503ab645981',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
