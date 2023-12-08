<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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

        return [
            'uuid' => $this->faker->uuid(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'poll_privacy' => $this->faker->randomElement(['private', 'public']),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'owner_uuid' => $user->uuid
        ];
    }
}
