<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Status;
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
        $roles = ["Admin", "RH", "Chef d'agence", "Gestionnaire fournisseur", "Gestionnaire commandes", "Locataire"];

        foreach ($roles as $role) {
            DB::table("roles")->insert([
                'name' => $role
            ]);
        }

        $status = [
            0 => "Indisponible", 
            1 => "Disponible",
            2 => "En reparation"
        ];

        foreach ($status as $key => $stat) {
            DB::table("status")->insert([
                'id' => $key,
                'label' => $stat
            ]);
        }

        $allOrderStatus = [
            0 => "Rejetée",
            1 => "En attente de validation",
            2 => "Approuvée",
            3 => "Expirée"
        ];

        foreach ($allOrderStatus as $key => $orderStatus) {
            DB::table("orderstatus")->insert([
                'id' => $key,
                'label' => $orderStatus
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
                            'supplier_id' => $suppliers->random()->id,
                            'status_id' => Status::all()->random()->id
                        ]);
                });
            });
            
        
        User::factory()->count(4)->create(['role_id' => 4]);
        User::factory()->count(4)->create(['role_id' => 5]);

        $vehicles = Vehicle::all();
        User::factory()
        ->count(4)
        ->create(["role_id" => 6])
        ->each(function ($user, $key) use ($vehicles){
            Order::factory()
            ->create([
                "user_id" => $user->id,
                "vehicle_id" => $vehicles->get($key)->id,
                "orderstatus_id" => OrderStatus::all()->random()->id
            ]);
        });


        $password = "Respons11";
        $hashPassword = password_hash($password, PASSWORD_BCRYPT);
        DB::table("users")->insert([ //crée le user admin
            'name' => "Admin",
            'email' => "admin.test@test.com",
            'email_verified_at' => now(),
            'password' => $hashPassword,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'role_id' => 1
        ]);

        User::factory() //crée le user RH
            ->create([
                'name' => "RH",
                'email' => "rh.test@test.com",
                'email_verified_at' => now(),
                'password' => $hashPassword,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => 2
            ]);

        User::factory() //crée le user chef d'agence
            ->create([
                'name' => "Chef Agence",
                'email' => "chefagence.test@test.com",
                'email_verified_at' => now(),
                'password' => $hashPassword,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => 3
            ]);

        User::factory() //crée le user gestionnaire fournisseur
            ->create([
                'name' => "Gestionnaire fournisseur",
                'email' => "gesf.test@test.com",
                'email_verified_at' => now(),
                'password' => $hashPassword,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => 4
            ]);

        User::factory() //crée le user gestionnaire commande
            ->create([
                'name' => "Gestionnaire commande",
                'email' => "gesc.test@test.com",
                'email_verified_at' => now(),
                'password' => $hashPassword,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => 5
            ]);
        
        User::factory() //crée le user locataire
            ->create([
                'name' => "Locataire",
                'email' => "loc.test@test.com",
                'email_verified_at' => now(),
                'password' => $hashPassword,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => 6
            ]);
    }
}
