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
            'name' => ucfirst($this->faker->words(2, true)),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(),
            'thumbnail' => $this->faker->url(),
            //'rating' => $this->faker->numberBetween(0, 5),
            //'age_from' => $this->faker->numberBetween(0, 18),
            //'age_to' => $this->faker->numberBetween(18, 60),
            //'active' => $this->faker->boolean(),
            //'color' => $this->faker->hexColor(),
            //'files' => [],
            //'data' => [],
            //'code' => ''
        ];
    }
}
