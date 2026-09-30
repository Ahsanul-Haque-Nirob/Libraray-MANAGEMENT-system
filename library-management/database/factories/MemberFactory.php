<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-2 years', 'now');
        $end   = fake()->dateTimeBetween($start, '+2 years');

        return [
            'member_code'      => 'LIB-' . strtoupper(fake()->unique()->bothify('??####')),
            'name'             => fake()->name(),
            'email'            => fake()->unique()->safeEmail(),
            'phone'            => fake()->phoneNumber(),
            'address'          => fake()->address(),
            'membership_start' => $start->format('Y-m-d'),
            'membership_end'   => $end->format('Y-m-d'),
            'status'           => fake()->randomElement(['active', 'active', 'active', 'inactive', 'suspended']),
        ];
    }

    public function active(): static
    {
        return $this->state(fn () => [
            'membership_start' => now()->subYear()->toDateString(),
            'membership_end'   => now()->addYear()->toDateString(),
            'status'           => 'active',
        ]);
    }
}
