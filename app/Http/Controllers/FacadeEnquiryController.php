<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacadeEnquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'facade_type'          => 'required|string|max:255',
            'house_building_name'  => 'required|string|max:255',
            'road_area_colony'     => 'nullable|string|max:255',
            'city'                 => 'required|string|max:100',
            'pincode'              => 'required|digits:6',
            'project_name'         => 'required|string|max:255',
            'glass_facade_type'    => 'nullable|string|max:255',
            'project_area'         => 'required|string|max:100',
            'building_type'        => 'required|string|max:100',
            'service_scope'        => 'required|string|max:255',
            'additional_details'   => 'nullable|string',
        ]);

        DB::table('facade_enquiries')->insert([
            'facade_type'          => $request->facade_type,
            'house_building_name'  => $request->house_building_name,
            'road_area_colony'     => $request->road_area_colony,
            'city'                 => $request->city,
            'pincode'              => $request->pincode,
            'project_name'         => $request->project_name,
            'glass_facade_type'    => $request->glass_facade_type,
            'project_area'         => $request->project_area,
            'building_type'        => $request->building_type,
            'service_scope'        => $request->service_scope,
            'additional_details'   => $request->additional_details,
            'created_at'           => now(),
            'updated_at'           => now(),
        ]);

        return redirect()->back()->with('success', 'Façade enquiry submitted successfully.');
    }
}