<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Nasi Goreng', 'Es Jeruk', 'Kwetiau', 'Capcai']),
            'slug' => $this->faker->randomElement(['nasi-goreng', 'es-eruk', 'kwetiau', 'capcai']),
            'price' => $this->faker->randomElement([12000, 15000, 10000, 20000]),
            'description' => $this->faker->realText,
            'image' => $this->faker->imageUrl,
        ];
    }
}
