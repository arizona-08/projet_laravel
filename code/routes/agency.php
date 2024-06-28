<?php

use App\Http\Controllers\AgencyController;
use Illuminate\Support\Facades\Route;

Route::resource('agencies', AgencyController::class)->middleware('auth');