<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

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
        $faker = fake('en_US');

        $products = [
            'Hammer',
            'Screwdriver Set',
            'Drill Machine',
            'Paint Brush',
            'Extension Cable',
            'Garden Shovel',
            'Water Hose',
            'LED Bulb',
            'Wood Screws Pack',
            'Measuring Tape'
        ];

        $descriptions = [
            'Durable tool designed for everyday use in home improvement and DIY projects.',
            'High-quality product built for reliability and long-lasting performance.',
            'Practical tool ideal for both professionals and home users.',
            'Designed for comfort and precision during various repair and building tasks.',
            'A versatile and essential tool for any toolbox or workshop.'
        ];

        return [
            'name' => $faker->randomElement($products),
            'description' => $faker->randomElement($descriptions),
            'price' => $faker->randomFloat(2, 49, 999),
            'color' => $faker->safeColorName(),
            'stock' => $faker->numberBetween(1, 100),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
