<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = \App\Models\User::factory(100)->create();
        $polls = \App\Models\Poll::factory(100)->create();
        $options = \App\Models\Option::factory(100)->create();

        foreach ($polls->where('poll_privacy', 'private') as $poll) {
            $randomUsers = $users->random(random_int(1, 5)); 
            $poll->users()->attach($randomUsers, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

       \App\Models\User::factory()->create([
            'uuid' => str::uuid(),
            'name' => 'Rodrigo Rodrigues',
            'email' => 'rodrigo@ivote.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin',
            'phone_number' => '1234567890'
        ]);

        \App\Models\User::factory()->create([
            'uuid' => str::uuid(),
            'name' => 'Pedro Silva',
            'email' => 'pedro@ivote.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin',
            'phone_number' => '987654321'
        ]);
    }
}