<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'make' => $this->faker->randomElement(['skoda', 'bmw', 'audi', 'mercedes', 'volkswagen', 'aston martin', 'BAC', 'toyota', 'lamborghini']),
            'model' => $this->faker->word(),
            'seats' => $this->faker->numberBetween(1,5),
            'drivetrain' => $this->faker->randomElement(['awd', 'fwd', 'rwd']),
            'transmission' => $this->faker->randomElement(['auto', 'manual'])
        ];
    }
}
