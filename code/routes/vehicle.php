<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::resource('vehicles', VehicleController::class)->except([
        'show'
    ])
    ->middleware('auth')
    ->middleware('role:admin,supplierManager,orderManager');