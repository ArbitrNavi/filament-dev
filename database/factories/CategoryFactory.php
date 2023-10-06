<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'is_active' => $this->faker->boolean,
            'priority' => $this->faker->numberBetween(1, 20),
        ];
    }
}
