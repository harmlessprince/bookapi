<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'isbn' => $this->faker->isbn10(),
            'authors' => [$this->faker->name, $this->faker->name],
            'number_of_pages' => random_int(100, 3000),
            'country' => $this->faker->country(),
            'publisher' => $this->faker->company(),
            'release_date' => $this->faker->date(),
        ];
    }
}
