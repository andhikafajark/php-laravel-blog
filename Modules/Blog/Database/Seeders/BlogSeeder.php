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
        Blog::create([
            'id' => 'e976eba4-6853-4405-9549-a503ab645981',
            'title' => 'Test Title',
            'slug' => str('Test Title')->slug(),
            'content' => 'Test Content',
            'headline_image_id' => 'e976eba4-6853-4405-9549-a503ab645981',
            'is_active' => true,
            'created_by' => 'e976eba4-6853-4405-9549-a503ab645981',
            'created_at' => Carbon::now()
        ])->categories()
            ->sync(array_fill_keys([
                'e976eba4-6853-4405-9549-a503ab645981',
                'e976eba4-6853-4405-9549-a503ab645982'
            ], [
                'created_by' => 'e976eba4-6853-4405-9549-a503ab645981'
            ]));
    }
}
