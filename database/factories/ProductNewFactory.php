<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductNewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'new_id' => News::all()->random()->id,
            'product_id' => Product::all()->random()->id,
        ];
    }
}
