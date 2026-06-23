<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GymMember>
 */
class GymMemberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'member_code' => 'MEM-' . strtoupper(fake()->bothify('####')),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'birth_date' => fake()->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d'),
            'gender' => fake()->randomElement(['M', 'F']),
            'membership_type' => fake()->randomElement(['monthly', 'quarterly', 'annual']),
            'start_date' => now()->subMonths(rand(1, 12)),
            'expire_date' => now()->addMonths(rand(1, 12)),
            'emergency_contact' => fake()->phoneNumber(),
            'status' => 'active',
        ];
    }
}