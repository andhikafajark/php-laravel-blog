<?php

namespace Modules\Blog\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\Blog\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Blog::insert([
            [
                'id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'blog_category_id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'title' => 'Test Title',
                'slug' => str('Test Title')->slug(),
                'content' => 'Test Content',
                'headline_image_id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'is_active' => true,
                'created_by' => 'e976eba4-6853-4405-9549-a503ab645981',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
