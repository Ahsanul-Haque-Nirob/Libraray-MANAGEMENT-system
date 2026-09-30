<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Fiction', 'Non-Fiction', 'Science', 'History', 'Biography',
            'Technology', 'Philosophy', 'Psychology', 'Art', 'Travel',
            'Children', 'Horror', 'Mystery', 'Romance', 'Self-Help',
        ]);

        return [
            'name'        => $name,
            'slug'        => Str::slug($name),
            'description' => fake()->sentence(10),
        ];
    }
}
