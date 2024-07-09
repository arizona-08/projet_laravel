<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $suppliers = Supplier::factory()->count(10)->create();

        User::factory()->count(4)->create(['role_id' => 2]);
        User::factory()
            ->count(4)
            ->create(['role_id' => 3])
            ->each(function ($user) use ($suppliers){
                $agencies = Agency::factory()
                    ->count(rand(1, 3))
                    ->create(['user_id' => $user->id]);
                
                $agencies->each(function ($agency) use ($suppliers){
                    Vehicle::factory()
                        ->count(rand(1, 5))
                        ->create([
                            'agency_id' => $agency->id,
                            'supplier_id' => $suppliers->random()->id
                        ]);
                });
            });
            
        
        User::factory()->count(4)->create(['role_id' => 4]);
        User::factory()->count(4)->create(['role_id' => 5]);
        $password = "Respons11";
        $hashPassword = password_hash($password, PASSWORD_BCRYPT);
        DB::table("users")->insert([
            'name' => "Marc Doe",
            'email' => "test@test.com",
            'email_verified_at' => now(),
            'password' => $hashPassword,
            'remember_token' => Str::random(10),
            'role_id' => 1
        ]);
    }
}
