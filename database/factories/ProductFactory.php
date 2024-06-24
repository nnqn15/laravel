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
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'image' => rand(1,34).'.jpg',
            'image1' => rand(1,34).'.jpg',
            'image2' => rand(1,34).'.jpg',
            'image3' => rand(1,34).'.jpg',
            'price' => rand(300000, 1000000),
            'sale' => rand(100000, 299000),
            'description' => fake()->sentence(),
            'detail' => fake()->text(1000),
            'status' => 1,
            'category_id' => rand(1, 15),
        ];
    }
}
