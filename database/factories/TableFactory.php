<?php

namespace Database\Factories;

use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Table::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Table 1', 'Table 2', 'Table 3']),
            'slug' => $this->faker->randomElement(['table-1', 'table-2', 'table-3']),
        ];
    }
}
