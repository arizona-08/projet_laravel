<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    public function index(){ //affiche tous les véhicule disponible à la commande
        $availableVehicles = Vehicle::with(['agency', 'status'])
            ->where("status_id", 1)
            ->get();
        return view("customerOrders.index", compact("availableVehicles"));
    }

    public function show(Vehicle $vehicle){ //affiche un véhicule disponible à la commande
        $vehicle->load(['agency', 'status']);
        $user = Auth::user();
        return view("customerOrders.show", compact("vehicle", "user"));
    }

    public function store(Request $request){ //crée une commande
        $validate = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'vehicle_id' => 'required',
            'user_id' => 'required',
        ], [
            'start_date.required' => 'Le date de début est requise',
            'end_date.required' => 'Le date de fin est requise',
            'vehicle_id.required' => 'Le véhicule est requis',
            'user_id.required' => 'L\'utilisateur est requis',
        ]);

        $vehicules = Vehicle::where("id", $validate["vehicle_id"])
            ->get();

        $vehicle = $vehicules[0];
        Order::create([
            "start_date" => $validate["start_date"],
            "end_date" => $validate["end_date"],
            "vehicle_id" => $validate["vehicle_id"],
            "orderstatus_id" => 1,
            "user_id" => Auth::id()
        ]);
        return to_route("orders.showOrders"); // Rediriger vers la liste des orders
    }

    
}
