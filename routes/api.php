<?php

use App\Http\Controllers\Api\V1\ServiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('throttle:api')->group(function () {
    Route::get('/health', function () {
        return response()->json([
            'data' => [
                'status' => 'ok',
                'version' => 'v1',
            ],
        ]);
    });

    Route::get('/services', [ServiceController::class, 'index']);
});
