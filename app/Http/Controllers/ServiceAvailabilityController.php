<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class ServiceAvailabilityController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);

        $search = $request->search;

        // 🔥 Search by pincode OR city
        $area = Area::where('pincode', $search)
                    ->orWhere('city', 'LIKE', "%$search%")
                    ->first();

        if (!$area) {
            return response()->json([
                'available' => false,
                'message' => '❌ Service not available in your area'
            ]);
        }

        $services = $area->services()
            ->wherePivot('is_available', true)
            ->pluck('name');

        return response()->json([
            'available' => true,
            'services' => $services
        ]);
    }
}