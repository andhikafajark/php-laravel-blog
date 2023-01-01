<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::insert([
            [
                'id' => 'e976eba4-6853-4405-9549-a503ab645981',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'name' => 'Admin',
                'is_active' => true,
                'created_by' => 'e976eba4-6853-4405-9549-a503ab645981',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
