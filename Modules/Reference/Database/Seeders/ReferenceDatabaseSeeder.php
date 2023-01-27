<?php

namespace Modules\Reference\Database\Seeders;

use Illuminate\Database\Seeder;

class ReferenceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            CategorySeederTableSeeder::class
        ]);
    }
}
