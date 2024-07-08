<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ["Admin", "RH", "Chef d'agence", "Gestionnaire fournisseur", "Gestionnaire commandes"];

        $status = ["Disponible", "Indisponible"];

        foreach ($status as $stat) {
            DB::table("status")->insert([
                'label' => $stat
            ]);
        }

        foreach ($roles as $role) {
            DB::table("roles")->insert([
                'name' => $role
            ]);
        }

        // Create suppliers first
        Supplier::factory()->count(10)->create();

        $users = User::factory()->count(10)->create();
        $agencyChiefs = $users->where("role_id", "=", "3");
        // Create as many agencies as many users with the role_id 3
        foreach ($agencyChiefs as $chief) {
            $agency = Agency::factory()->create(['user_id' => $chief->id]);

            // Create between 0 and 5 vehicles for each agency
            Vehicle::factory()->count(rand(0, 5))->create([
                'agency_id' => $agency->id,
                'supplier_id' => Supplier::inRandomOrder()->first()->id // Assign a random supplier to each vehicle
            ]);
        }
    }
}
