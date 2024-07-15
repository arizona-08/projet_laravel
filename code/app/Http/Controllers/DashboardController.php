<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use App\Models\Supplier;
use App\Models\Vehicle;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function show()
    {
        $agencies = Agency::all();
        $data = [];
        $supplierData = [];

        // Calcul des données pour les agences
        foreach ($agencies as $agency) {
            $vehicles = $agency->vehicles;

            $totalVehicles = $vehicles->count();
            $rentedCount = $vehicles->where('status_id', 0)->count();
            $availableCount = $vehicles->where('status_id', 1)->count();

            $totalRevenue = 0;
            $totalOrders = 0;
            $totalDuration = 0;

            foreach ($vehicles as $vehicle) {
                $orders = $vehicle->orders;

                foreach ($orders as $order) {
                    if (!$order->start_date || !$order->end_date) {
                        Log::error("Order ID {$order->id} missing dates: start_date={$order->start_date}, end_date={$order->end_date}");
                        continue;
                    }

                    $start_date = Carbon::parse($order->start_date);
                    $end_date = Carbon::parse($order->end_date);

                    if ($vehicle->price_per_day <= 0) {
                        Log::warning("Invalid price per day for vehicle ID {$vehicle->id}: price_per_day={$vehicle->price_per_day}");
                        continue;
                    }

                    $days = $start_date->diffInDays($end_date);
                    if ($days <= 0) {
                        Log::error("Invalid number of days for order ID {$order->id}: start_date={$start_date}, end_date={$end_date}, days={$days}");
                        continue;
                    }

                    $revenue = $days * $vehicle->price_per_day;
                    $totalRevenue += $revenue;
                    $totalDuration += $days;
                    $totalOrders++;
                }
            }

            $data[] = [
                'agency' => $agency->label,
                'rented_count' => $rentedCount,
                'availability_rate' => $totalVehicles > 0 ? round(($availableCount / $totalVehicles) * 100, 2) : 0,
                'total_revenue' => $totalRevenue,
                'average_revenue' => $totalOrders > 0 ? round($totalRevenue / $totalOrders, 2) : 0,
                'average_duration' => $totalOrders > 0 ? round($totalDuration / $totalOrders, 2) : 0
            ];
        }

        // Calcul des données pour les fournisseurs en excluant les revenus des agences
        $suppliers = Supplier::all();

        foreach ($suppliers as $supplier) {
            $vehicles = $supplier->vehicles;

            $totalRevenue = 0;
            $totalOrders = 0;
            $totalDuration = 0;

            foreach ($vehicles as $vehicle) {
                // Vérifier si le véhicule est fourni à une agence, si oui, ignorer
                if ($vehicle->agency_id) {
                    continue;
                }

                $orders = $vehicle->orders;

                foreach ($orders as $order) {
                    if (!$order->start_date || !$order->end_date) {
                        Log::error("Order ID {$order->id} missing dates: start_date={$order->start_date}, end_date={$order->end_date}");
                        continue;
                    }

                    $start_date = Carbon::parse($order->start_date);
                    $end_date = Carbon::parse($order->end_date);

                    if ($vehicle->price_per_day <= 0) {
                        Log::warning("Invalid price per day for vehicle ID {$vehicle->id}: price_per_day={$vehicle->price_per_day}");
                        continue;
                    }

                    $days = $start_date->diffInDays($end_date);
                    if ($days <= 0) {
                        Log::error("Invalid number of days for order ID {$order->id}: start_date={$start_date}, end_date={$end_date}, days={$days}");
                        continue;
                    }

                    $revenue = $days * $vehicle->price_per_day;
                    $totalRevenue += $revenue;
                    $totalDuration += $days;
                    $totalOrders++;
                }
            }

            $supplierData[] = [
                'supplier' => $supplier->label,
                'average_revenue' => $totalOrders > 0 ? round($totalRevenue / $totalOrders, 2) : 0,
                'average_duration' => $totalOrders > 0 ? round($totalDuration / $totalOrders, 2) : 0
            ];
        }

        $vehicleStatusCount = [
            'maintenance' => Vehicle::where('status_id', 2)->count(),
            'out_of_service' => Vehicle::where('status_id', 3)->count()
        ];

        return view('dashboard', [
            'data' => $data,
            'supplierData' => $supplierData,
            'vehicleStatusCount' => $vehicleStatusCount
        ]);
    }

    public function index()
    {
        return view('dashboard');
    }
}
