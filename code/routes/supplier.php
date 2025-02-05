<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::resource('suppliers', SupplierController::class)
    ->middleware('auth')
    ->middleware("role:admin|supplierManager");
