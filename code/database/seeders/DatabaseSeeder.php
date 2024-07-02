<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\User;
use App\Models\Vehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        foreach($roles as $role){
            DB::table("roles")->insert([
                'name' => $role
            ]);
        }

        $users = User::factory()->count(10)->create();
        // Create exactly 10 agencies, assigning them to the users
        foreach ($users as $user) {
            $agency = Agency::factory()->create(['user_id' => $user->id]);

            // Create between 0 and 5 vehicles for each agency
            Vehicle::factory()->count(rand(0, 5))->create(['agency_id' => $agency->id]);
        }
    }
}
