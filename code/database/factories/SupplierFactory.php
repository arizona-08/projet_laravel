<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'label' => $this->faker->company,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Supplier $supplier) {
            // Create between 1 and 5 vehicles for each supplier
            Vehicle::factory()->count(rand(1, 5))->create(['supplier_id' => $supplier->id]);
        });
    }
}
