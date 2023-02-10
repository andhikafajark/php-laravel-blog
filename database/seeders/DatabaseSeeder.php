<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Blog\Database\Seeders\BlogDatabaseSeeder;
use Modules\Reference\Database\Seeders\ReferenceDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            FileSeeder::class,
            ReferenceDatabaseSeeder::class,
            BlogDatabaseSeeder::class,
            CommentSeeder::class
        ]);
    }
}
