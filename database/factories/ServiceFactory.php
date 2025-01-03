<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type'  => $this->faker->randomElement(['hair', 'beard', 'both', 'shave', 'trim', 'color']),
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
