<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(100)->create();
        \App\Models\Poll::factory(100)->create();

       \App\Models\User::factory()->create([
            'uuid' => str::uuid(),
            'name' => 'Rodrigo Rodrigues',
            'email' => 'rodrigo@ivote.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin',
            'phone_number' => '1234567890',
            'is_deleted' => false
        ]);

        \App\Models\User::factory()->create([
            'uuid' => str::uuid(),
            'name' => 'Pedro Silva',
            'email' => 'pedro@ivote.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin',
            'phone_number' => '987654321',
            'is_deleted' => false
        ]);
    }
}
