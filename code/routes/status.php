<?php

use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

Route::resource('status', StatusController::class)
    ->middleware('auth');