<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AttachmentFactory extends Factory
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
            'attachment' => $this->faker->sentence(),
            'poll_uuid' => $poll->uuid,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
