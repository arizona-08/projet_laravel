<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Faker\Provider\FakeCar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new FakeCar($this->faker));
        $vehicle = $this->faker->vehicleArray();
        return [
            'model' => $vehicle['model'],
            'marque' => $vehicle['brand'],
            'last_maintenance' => date("Y-m-d H:i:s"),
            'nb_kilometrage' => $this->faker->numberBetween(10000, 300000),
            'nb_serie' => $this->faker->numberBetween(1000, 9999),
            // 'agency_id' => \App\Models\Agency::factory() //laisse AgencyFactory s'en charger
        ];
    }
}
