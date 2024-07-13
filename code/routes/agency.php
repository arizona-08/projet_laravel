<?php

use App\Http\Controllers\AgencyController;
use Illuminate\Support\Facades\Route;

Route::resource('agencies', AgencyController::class)
    ->middleware('auth')
    ->middleware('role:admin,agencyHead'); //regarder config/roles.php pour voir le nom des roles disponibles