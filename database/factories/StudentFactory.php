<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory()->create(['type' => 'student'])->id,
            'name' => fake()->name(),
            'birth_date' => fake()->date('Y-m-d', '-10 years'),
            'gender' => fake()->randomElement(['male', 'female']),
            'classroom_id' => rand(1, 5),
        ];
    }
}
