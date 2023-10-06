<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'image_path' => $this->faker->imageUrl,
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(10, 1000),
            'is_active' => $this->faker->boolean,
            'priority' => $this->faker->numberBetween(1, 100),
            'category_id' => Category::factory(), // Создаем связь с моделью Category
        ];
    }
}
