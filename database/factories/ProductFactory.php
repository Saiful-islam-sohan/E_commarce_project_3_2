<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
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
        $name = $this->faker->sentence(3);
        return [
            'category_id'=>Category::select('id')->get()->random()->id,
            'name'=>$name,
            'slug'=>Str::slug($name),
            'product_code' => $this->faker->numberBetween(100, 10000),
            'product_price' => $this->faker->numberBetween(100, 10000),
            'product_off_price' => $this->faker->numberBetween(10, 25),
            'product_stock' => $this->faker->numberBetween(5, 100),
            'alert_quantity' => $this->faker->numberBetween(1, 10),
            'short_discription' => $this->faker->paragraph(3),
            'delivary' => $this->faker->paragraph(3),
            'long_discription_up' => $this->faker->paragraph(6),
            'short_discription_down' => $this->faker->paragraph(6),
            'product_image' => "default_product.jpg",
            'product_rating' => $this->faker->numberBetween(0, 5),



        ];
    }
}
