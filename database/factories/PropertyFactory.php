<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => $this->faker->paragraph(),
            'title' => $this->faker->sentence(),
            'arrendador_id' => User::role('arrendador')->get()->random()->id
        ];
    }
}
