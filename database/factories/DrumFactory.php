<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drum>
 */
class DrumFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->words(2, true), // Random drum name
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 5, 100), // Random price between 5 and 100
        ];
    }
}
