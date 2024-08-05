<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Revenue>
 */
class RevenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        // Generate a random month (1 to 12)
        $month = fake()->numberBetween(1, 12);

        $day = fake()->numberBetween(1, cal_days_in_month(CAL_GREGORIAN, $month, 2024));

        $date = \Carbon\Carbon::create(2024, $month, $day);

        return [
            'revenue' => fake()->numberBetween(100000, 500000),
            'date' => $date->format('Y-m-d'),
        ];
    }
}
