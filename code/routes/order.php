<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::put("/customer-orders/{order}", [OrderController::class, "handleOrder"])->name("orders.handleOrder");
Route::get("/customer-orders", [OrderController::class, "showOrders"])->name("orders.showOrders");
Route::resource('orders', OrderController::class)
    ->except(['show'])
    ->middleware('auth');

