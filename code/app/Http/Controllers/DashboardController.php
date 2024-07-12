<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Vehicle;



class DashboardController extends Controller
{
    public function show()
    {
        // On récupère tous les fournisseurs
        $suppliers = Supplier::all();

        // Tableau pour stocker le nombre de véhicules loués par fournisseur
        $vehiclesRentedCount = [];
        $availabilityRate = [];

        foreach ($suppliers as $supplier) {
            // Nombre de véhicules loués (status_id 0) par fournisseur
            $rentedCount = Vehicle::where('supplier_id', $supplier->id)
                ->where('status_id', 0)
                ->count();

            // Nombre total de véhicules par fournisseur
            $totalVehicles = Vehicle::where('supplier_id', $supplier->id)->count();

            // Calcul du taux de disponibilité
            $availableCount = Vehicle::where('supplier_id', $supplier->id)
                ->where('status_id', 1)
                ->count();

            $availabilityRate[$supplier->label] = $totalVehicles > 0 ? round(($availableCount / $totalVehicles) * 100, 2) : 0;
            $vehiclesRentedCount[$supplier->label] = $rentedCount;
        }

        return view('dashboard', [
            'vehiclesRentedCount' => $vehiclesRentedCount,
            'availabilityRate' => $availabilityRate,
        ]);
    }

    public function index()
    {
        return view('dashboard');
    }
}
