<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/vehicle.php';
require __DIR__.'/agency.php';
require __DIR__.'/supplier.php';
require __DIR__.'/order.php';
require __DIR__.'/role.php';
require __DIR__.'/user.php';
require __DIR__.'/supplierVehicle.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/customerOrder.php';