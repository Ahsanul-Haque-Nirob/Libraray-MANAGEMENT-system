<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        $total     = fake()->numberBetween(1, 10);
        $available = fake()->numberBetween(0, $total);

        return [
            'title'            => fake()->sentence(fake()->numberBetween(2, 6), false),
            'isbn'             => fake()->unique()->isbn13(),
            'author_id'        => Author::inRandomOrder()->first()?->id ?? Author::factory(),
            'category_id'      => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'description'      => fake()->paragraphs(2, true),
            'publisher'        => fake()->company(),
            'published_year'   => fake()->year(),
            'total_copies'     => $total,
            'available_copies' => $available,
            'status'           => $available > 0 ? 'available' : 'unavailable',
        ];
    }

    public function available(): static
    {
        return $this->state(fn () => [
            'total_copies'     => 5,
            'available_copies' => 5,
            'status'           => 'available',
        ]);
    }

    public function unavailable(): static
    {
        return $this->state(fn () => [
            'total_copies'     => 3,
            'available_copies' => 0,
            'status'           => 'unavailable',
        ]);
    }
}
