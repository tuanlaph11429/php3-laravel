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
    public function definition()
    {
            $name = $this->faker->name();
            return [
                'name' => $name,
                'description' => $this->faker->text(),
                'short_description'=> $this->faker->text(),
                'price' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000),
                'thumbnail_url'=> $this->faker->url(),
                'quantity'=> $this->faker->numberBetween(0, 100),
                'category_id' => Category::all()->random()->id,
                'status' => $this->faker->numberBetween(0, 1),

                
            ];
        
    }
}
