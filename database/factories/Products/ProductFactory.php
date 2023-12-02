<?php

namespace Database\Factories\Products;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 3),
            'name' => ucfirst($this->faker->words(2, true)),
            'slug' => $this->faker->slug(),
            'text' => $this->faker->text(),
            'thumbnail' => $this->faker->url(),
            'description' => $this->faker->text(),
            'keywords' => ucfirst($this->faker->words(2, true)),
            'is_publish' => $this->faker->boolean(),
        ];
    }
}
