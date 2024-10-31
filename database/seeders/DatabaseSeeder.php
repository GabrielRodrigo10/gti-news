<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Noticia;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'cargo' => '1',
            'password' => hash::make('123'),
        ]);
        
        User::factory(10)->create();

        Noticia::factory(100)->create();


    }
}
