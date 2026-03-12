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
            'Paint Roller',
            'Paint Tray',
            'Extension Cable',
            'Garden Shovel',
            'Water Hose',
            'Pipe Wrench',
            'PVC Pipe',
            'Plumbing Tape',
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

        $name = $faker->randomElement($products);

        // Map product names (or keywords) to categories to keep seeding realistic
        // Order matters: place more specific categories first to avoid overlaps
        $mapping = [
            'Paint' => ['Paint Brush', 'Paint Roller', 'Paint Tray'],
            'Plumbing' => ['Pipe Wrench', 'PVC Pipe', 'Plumbing Tape', 'Water Hose'],
            'Electrical' => ['Extension Cable', 'LED Bulb'],
            'Garden' => ['Garden Shovel'],
            'Building Materials' => ['Wood Screws Pack', 'Measuring Tape'],
            'Tools' => ['Hammer', 'Screwdriver Set', 'Drill Machine'],
        ];

        $categoryId = null;

        foreach ($mapping as $catName => $items) {
            if (in_array($name, $items)) {
                $category = Category::where('name', $catName)->first();
                if ($category) {
                    $categoryId = $category->id;
                }
                break;
            }
        }

        // Fallback to random existing category if mapping didn't find one
        if (is_null($categoryId)) {
            $categoryId = Category::inRandomOrder()->first()->id;
        }

        return [
            'name' => $name,
            'description' => $faker->randomElement($descriptions),
            'price' => $faker->randomFloat(2, 49, 999),
            'color' => $faker->safeColorName(),
            'stock' => $faker->numberBetween(1, 100),
            'category_id' => $categoryId,
        ];
    }
}
