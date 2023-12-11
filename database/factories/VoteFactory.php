<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = \App\Models\User::factory()->create();
        $poll = \App\Models\Poll::factory()->create();
        $option = \App\Models\Option::factory()->create();

        return [
            'uuid' => $this->faker->uuid(),
            'poll_uuid' => $poll->uuid,
            'user_uuid' => $user->uuid,
            'option_uuid' => $option->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
