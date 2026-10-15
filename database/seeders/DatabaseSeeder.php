<?php

namespace Database\Seeders; //base seeder

use App\Models\User; // model user
use Illuminate\Database\Console\Seeds\WithoutModelEvents; 
use Illuminate\Database\Seeder; // base seeder
use Illuminate\Support\Facades\Hash; // facade hash untuk enkripsi

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // 1. Buat user admin default

        User::create([
            'name' => 'Panitia',
            'email' => 'panitia@gmail.com',
            'password' =>  Hash::make('password123'), //enkripsi password (admin login dengan ini)
        ]);

        // 2. panggil seeder makanan
        $this->call([
            EventSeeder::class,
        ]);
    }
}
