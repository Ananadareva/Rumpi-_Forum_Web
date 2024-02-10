<?php

namespace Database\Seeders;

use App\Models\User; // Assuming your User model is in the 'App\Models' namespace

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
    }
}
