<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Poll>
 */
class PollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = \App\Models\User::factory()->create();
        $title = $this->faker->sentence();
        $title = Str::limit($title, 20);

        $description = $this->faker->paragraph();
        $description = Str::limit($title, 50);


        return [
            'uuid' => $this->faker->uuid(),
            'title' => $title,
            'description' => $description,
            'poll_privacy' => $this->faker->randomElement(['private', 'public']),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'owner_uuid' => $user->uuid
        ];
    }
}
