<?php

use App\Http\Controllers\VehicleController;

use Illuminate\Support\Facades\Route;

Route::resource('vehicles', VehicleController::class)
    ->middleware('auth')
    ->middleware('role:admin|supplierManager|orderManager|agencyHead');

Route::get("/create-vehicle-for/{agency}", [ VehicleController::class, "create"])
    ->middleware('auth')
    ->middleware('role:admin|agencyHead')
    ->name("vehicles.createVehicleFor");