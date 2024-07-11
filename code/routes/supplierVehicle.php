<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;

Route::get('/api/vehicles/by-supplier/{supplierId}', [VehicleController::class, 'getVehiclesBySupplier']);
