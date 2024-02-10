<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        

        $faker = Faker::create('id_ID'); // Set locale ke bahasa Indonesia

        // Generate dummy data
        for ($i = 1; $i <= 10; $i++) {
            Post::create([
                'user_id' => rand(1, 4), // Menggunakan rand() untuk memilih pengguna secara acak
                'content' => $faker->paragraph,
                'like_count' => rand(0, 100),
            ]);
        }
    }
}
