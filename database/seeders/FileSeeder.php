<?php

namespace Database\Seeders;

use App\Models\File;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        File::insert([
            [
                'id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'original_name' => 'example.png',
                'hash_name' => 'dV5mmvyW9bhk34HdCwUdDyEROM19Ay6igBSvjhxD.png',
                'path' => 'public/files/blogs/headlines/',
                'extension' => 'png',
                'mime_type' => 'image/png',
                'size' => '15578',
                'created_by' => 'e976eba4-6853-4405-9549-a503ab645981',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
