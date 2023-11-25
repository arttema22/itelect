<?php

namespace Database\Factories\Contacts;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contacts\Company>
 */
class CompanyFactory extends Factory
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
            'opf_id' => fake()->numberBetween(1, 2),
            'name_full' => fake()->company,
            'name_short' => fake()->company,
            'inn' => fake()->numerify('############'),
            'ogrn' => fake()->numerify('#############'),
            'ogrnip' => fake()->numerify('###############'),
            'okpo' => fake()->numerify('########'),
            'okato' => fake()->numerify('###########'),
            'oktmo' => fake()->numerify('###########'),
            'okogu' => fake()->numerify('#######'),
            'okfs' => fake()->numerify('##'),
            'kpp' => fake()->numerify('#########'),
            'okved' => fake()->numerify(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('###########'),
            'description' => fake()->text(),
        ];
    }
}
