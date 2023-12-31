<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Options>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $poll = \App\Models\Poll::factory()->create();

        return [
            'uuid' => $this->faker->uuid(),
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'poll_uuid' => $poll->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}