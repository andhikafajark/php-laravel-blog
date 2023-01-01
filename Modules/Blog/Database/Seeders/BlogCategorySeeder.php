<?php

namespace Modules\Blog\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\Blog\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        BlogCategory::insert([
            [
                'id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'title' => 'Technology',
                'slug' => str('Technology')->slug(),
                'created_by' => 'e976eba4-6853-4405-9549-a503ab645981',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 'e976eba4-6853-4405-9549-a503ab645982',
                'title' => 'Animal',
                'slug' => str('Animal')->slug(),
                'created_by' => 'e976eba4-6853-4405-9549-a503ab645981',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
