<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Api\V1\MobileAppController;
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

    /*
    |--------------------------------------------------------------------------
    | Mobile Customer Flow
    |--------------------------------------------------------------------------
    | Flow chart:
    | Open app -> Login/Register -> Dashboard -> Post Project -> Match Vendors
    | -> Show first 3 free -> Payment for more -> View vendor -> Enquiry.
    |
    | This project currently uses OTP/session login for customers. For a true
    | mobile token login, install Sanctum/Passport and move protected routes
    | into an auth middleware group.
    */

    Route::prefix('customer')->group(function () {
        Route::match(['get', 'post'], '/send-otp', [CustomerController::class, 'sendOtp'])
            ->name('api.customer.send-otp');
        Route::match(['get', 'post'], '/verify-otp', [CustomerController::class, 'verifyOtp'])
            ->name('api.customer.verify-otp');

        Route::get('/dashboard', [MobileAppController::class, 'dashboard']);
        Route::get('/profile', [MobileAppController::class, 'profile']);
        Route::match(['post', 'put', 'patch'], '/profile', [MobileAppController::class, 'updateProfile'])
            ->name('api.customer.profile.update');
        Route::get('/metadata', [MobileAppController::class, 'metadata']);
        Route::get('/project-form', [MobileAppController::class, 'projectForm']);
        Route::get('/project-types/{workType}', [MobileAppController::class, 'projectTypes']);
        Route::get('/cities/{city}/areas', [MobileAppController::class, 'areasByCity']);
        Route::get('/pincodes', [MobileAppController::class, 'pincodes']);
        Route::get('/projects', [MobileAppController::class, 'projects']);
        Route::post('/projects', [MobileAppController::class, 'storeProject']);
    });

    Route::prefix('vendors')->group(function () {
        Route::get('/', [MobileAppController::class, 'vendors']);
        Route::get('/{vendor}', [MobileAppController::class, 'vendorDetails']);
        Route::post('/{vendor}/enquiry', [MobileAppController::class, 'sendEnquiry']);
    });

    Route::prefix('payments')->group(function () {
        Route::get('/options', [MobileAppController::class, 'paymentOptions']);
        Route::post('/unlock-more-vendors', [MobileAppController::class, 'unlockMoreVendorProfiles']);
    });
});
