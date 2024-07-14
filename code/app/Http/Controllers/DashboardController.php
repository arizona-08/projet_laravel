<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Vehicle;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{

    public function show()
    {
        $suppliers = Supplier::all();
        $vehiclesRentedCount = [];
        $availabilityRate = [];
        $totalRevenueBySupplier = [];
        $averageRevenuePerRental = [];
        $averageRentalDuration = [];
        $vehicleStatusCount = [];
        $demandByVehicleType = [];

        foreach ($suppliers as $supplier) {
            $rentedCount = Vehicle::where('supplier_id', $supplier->id)
                ->where('status_id', 0)
                ->count();

            $totalVehicles = Vehicle::where('supplier_id', $supplier->id)->count();
            $availableCount = Vehicle::where('supplier_id', $supplier->id)
                ->where('status_id', 1)
                ->count();

            $availabilityRate[$supplier->label] = $totalVehicles > 0 ? round(($availableCount / $totalVehicles) * 100, 2) : 0;
            $vehiclesRentedCount[$supplier->label] = $rentedCount;

            $totalRevenue = 0;
            $totalOrders = 0;
            $totalDuration = 0;

            $orders = Order::whereHas('vehicle', function ($query) use ($supplier) {
                $query->where('supplier_id', $supplier->id);
            })->get();

            foreach ($orders as $order) {
                $vehicle = Vehicle::find($order->vehicle_id);

                // Vérification des dates de début et de fin
                if (!$order->start_date || !$order->end_date) {
                    Log::error("Order ID {$order->id} missing dates: start_date={$order->start_date}, end_date={$order->end_date}");
                    continue; // Ignorer cette commande si les dates ne sont pas présentes
                }

                $start_date = Carbon::parse($order->start_date);
                $end_date = Carbon::parse($order->end_date);

                // Ajouter des logs pour vérifier les dates avant et après conversion
                Log::info("Order ID {$order->id}: raw start_date={$order->start_date}, raw end_date={$order->end_date}");
                Log::info("Order ID {$order->id}: parsed start_date={$start_date}, parsed end_date={$end_date}");

                // Vérifier que le prix par jour est positif
                if ($vehicle->price_per_day <= 0) {
                    Log::warning("Invalid price per day for vehicle ID {$vehicle->id}: price_per_day={$vehicle->price_per_day}");
                    continue; // Ignorer cette commande si le prix par jour est négatif ou nul
                }

                // Calculer le nombre de jours en s'assurant qu'il est positif
                $days = $start_date->diffInDays($end_date);
                if ($days <= 0) {
                    Log::error("Invalid number of days for order ID {$order->id}: start_date={$start_date}, end_date={$end_date}, days={$days}");
                    continue; // Ignorer cette commande si le nombre de jours est négatif ou nul
                }

                $revenue = $days * $vehicle->price_per_day;
                $totalRevenue += $revenue;
                $totalDuration += $days;
                $totalOrders++;

                Log::info("Order ID {$order->id}: start_date={$start_date}, end_date={$end_date}, days={$days}, price_per_day={$vehicle->price_per_day}, revenue={$revenue}");
            }

            $totalRevenueBySupplier[$supplier->label] = $totalRevenue;
            $averageRevenuePerRental[$supplier->label] = $totalOrders > 0 ? round($totalRevenue / $totalOrders, 2) : 0;
            $averageRentalDuration[$supplier->label] = $totalOrders > 0 ? round($totalDuration / $totalOrders, 2) : 0;

            // Calcul du nombre de véhicules en maintenance ou hors service
            $vehicleStatusCount['maintenance'] = Vehicle::where('status_id', 2)->count(); // Exemple de status maintenance
            $vehicleStatusCount['out_of_service'] = Vehicle::where('status_id', 3)->count(); // Exemple de status hors service

            // Demande par type de véhicule
            $demandByVehicleType[$supplier->label] = Vehicle::select('model', \DB::raw('count(*) as total'))
                ->where('supplier_id', $supplier->id)
                ->groupBy('model')
                ->pluck('total', 'model');
        }

        return view('dashboard', [
            'vehiclesRentedCount' => $vehiclesRentedCount,
            'availabilityRate' => $availabilityRate,
            'totalRevenueBySupplier' => $totalRevenueBySupplier,
            'averageRevenuePerRental' => $averageRevenuePerRental,
            'averageRentalDuration' => $averageRentalDuration,
            'vehicleStatusCount' => $vehicleStatusCount,
            'demandByVehicleType' => $demandByVehicleType,
        ]);
    }

    public function index()
    {
        return view('dashboard');
    }
}
