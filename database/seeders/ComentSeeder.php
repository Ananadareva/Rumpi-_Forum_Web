<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Comment;
use Faker\Factory as Faker;

class ComentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
      
        $faker = Faker::create('id_ID'); // Set locale ke bahasa Indonesia

        // Generate dummy data komentar pada post_id = 3
        for ($i = 1; $i <= 5; $i++) {
            Comment::create([
                'user_id' => rand(5, 10), // Menggunakan rand() untuk memilih pengguna secara acak
                'post_id' => 1, // post_id = 3 sesuai permintaan
                'content' => $faker->paragraph,
            ]);
        }
    }
}
