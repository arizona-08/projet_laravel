<?php

namespace Database\Factories;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $baseDate = new DateTime();
        $interval = ["min" => 2, "max" => 14];
        $endDate = clone $baseDate;
        return [
            'start_date' => $baseDate,
            'end_date' => $endDate->add(new DateInterval('P'. rand($interval["min"], $interval["max"]). 'D')),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
