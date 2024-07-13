<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->middleware("role:tenant|admin|agencyHead|orderManager")->group(function () {
    Route::put("/customer-orders/{order}", [OrderController::class, "handleOrder"])->name("orders.handleOrder"); //route pour gérer une commande
    Route::get("/customer-orders", [OrderController::class, "showUserOrders"])->name("orders.showUserOrders");// route pour que le user puisse voir toutes ses commandes
    Route::resource('orders', OrderController::class)->except(['show']); // route pour CRUD des commandes
});