<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationCheckController extends Controller
{
    public function check(Request $request)
    {
        $area = trim($request->area ?? '');
        $pincode = trim($request->pincode ?? '');

        $location = DB::table('pincodes')
            ->join('area', 'pincodes.area_id', '=', 'area.id')
            ->join('city', 'pincodes.city_id', '=', 'city.id')
            ->select(
                'city.name as city_name',
                'area.name as area_name',
                'pincodes.pincode'
            )
            ->where(function ($query) use ($area, $pincode) {
                if (!empty($pincode)) {
                    $query->where('pincodes.pincode', $pincode);
                }

                if (!empty($area)) {
                    $query->orWhere('area.name', 'LIKE', '%' . $area . '%');
                }
            })
            ->first();

        if ($location) {
            return response()->json([
                'status' => true,
                'message' => 'Service available in your location.',
                'location' => $location
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Sorry, service is not available in this location.'
        ]);
    }
}