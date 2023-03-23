<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>fake()->word,
            'price'=>fake()->numberBetween(100,10000),
            'category_id'=>fake()->numberBetween(1,10),
            'image'=>fake()->imageUrl(),
            'reviews'=>fake()->numberBetween(0,5),
            'status_id'=>fake()->numberBetween(1,3)
        ];
    }
}
