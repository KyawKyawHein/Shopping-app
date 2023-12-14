<?php

namespace Database\Factories;

use App\Models\Category;
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
            "category_id" =>Category::all()->random()->id,
            "name"=>fake()->unique()->word,
            "slug"=>fake()->unique()->slug,
            "description"=>fake()->text,
            "image" =>"image/user.png",
            "price"=>fake()->numerify('###0'),
            "view_count"=>0
        ];  
    }
}
