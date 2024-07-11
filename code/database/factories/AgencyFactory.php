<?php

namespace Database\Factories;

use App\Models\Agency;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agency>
 */
class AgencyFactory extends Factory
{
    protected $model = Agency::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label' => $this->faker->company,
            'user_id' => User::factory(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
