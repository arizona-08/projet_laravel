<?php

use App\Http\Controllers\CustomerOrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){
    Route::get("/available-vehicles", [CustomerOrderController::class, 'index'])->name("customerOrders.index");
    Route::get("/available-vehicles/{vehicle}", [CustomerOrderController::class, 'show'])->name("customerOrders.show");
    Route::post("/available-vehicles", [CustomerOrderController::class, 'store'])->name("customerOrders.store");
});
