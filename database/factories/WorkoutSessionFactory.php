<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkoutSession>
 */
class WorkoutSessionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'session_date' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'trainer_name' => fake()->name(),
            'session_type' => fake()->randomElement(['Cardio', 'Strength Training', 'HIIT', 'Yoga', 'CrossFit']),
            'duration_minutes' => fake()->numberBetween(45, 120),
            'calories_burned' => fake()->numberBetween(300, 1200),
            'exercises_done' => fake()->sentence(8),
            'weight_kg' => fake()->randomFloat(2, 50, 120),
            'notes' => fake()->optional()->sentence(),
            'rating' => fake()->numberBetween(3, 5),
        ];
    }
}