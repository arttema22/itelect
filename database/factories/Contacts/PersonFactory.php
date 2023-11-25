<?php

namespace Database\Factories\Contacts;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact\Person>
 */
class PersonFactory extends Factory
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
            'name' => fake()->firstName(),
            'surname' => fake()->firstName(),
            'secname' => fake()->lastName(),
            'position' => fake()->jobTitle(),
            'phone' =>  fake()->numerify('###########'),
            'email' => fake()->email(),
            'created_at' => fake()->DateTime(),
            'created_at' => fake()->DateTime(),
        ];
    }
}
