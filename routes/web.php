<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceAvailabilityController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/check-services', [ServiceAvailabilityController::class, 'check']);