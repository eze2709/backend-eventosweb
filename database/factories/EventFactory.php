<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 week', '+1 week');
        $endDate = (clone $startDate)->modify('+'.rand(1, 3).' days');

        return [
            // librería Faker - datos falsos para pruebas
            // paragraph() uin parrafo aleatorio
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
