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

        $start_date = $this->faker->dateTimeBetween(date('Y-01-01'), '+1 year');
        $end_date = $this->faker->dateTimeBetween($start_date, '+1 year');

        return [
            'uuid' => $this->faker->uuid(),
            'title' => $title,
            'description' => $description,
            'poll_privacy' => $this->faker->randomElement(['private', 'public']),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'owner_uuid' => $user->uuid,
            'owner_uuid' => $user->uuid,
        ];
    }
}
