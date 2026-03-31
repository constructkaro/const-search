<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceAvailabilityController;

Route::domain('vendor.constructkaro.in')->group(function () {
    Route::get('/', function () {
        return 'Hello from vendor.constructkaro.in';
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/check-services', [ServiceAvailabilityController::class, 'check']);