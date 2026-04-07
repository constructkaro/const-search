<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StructuralAuditEnquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'audit_type'            => 'required|string|max:255',
            'house_building_name'   => 'required|string|max:255',
            'road_area_colony'      => 'nullable|string|max:255',
            'city'                  => 'required|string|max:100',
            'pincode'               => 'required|digits:6',
            'project_name'          => 'required|string|max:255',
            'building_age'          => 'nullable|integer|min:0',
            'property_type'         => 'required|string|max:100',
            'number_of_floors'      => 'nullable|integer|min:0',
            'occupancy_status'      => 'required|string|max:100',
            'construction_type'     => 'required|string|max:100',
            'additional_details'    => 'nullable|string',
        ]);

        DB::table('structural_audit_enquiries')->insert([
            'audit_type'            => $request->audit_type,
            'house_building_name'   => $request->house_building_name,
            'road_area_colony'      => $request->road_area_colony,
            'city'                  => $request->city,
            'pincode'               => $request->pincode,
            'project_name'          => $request->project_name,
            'building_age'          => $request->building_age,
            'property_type'         => $request->property_type,
            'number_of_floors'      => $request->number_of_floors,
            'occupancy_status'      => $request->occupancy_status,
            'construction_type'     => $request->construction_type,
            'additional_details'    => $request->additional_details,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        return redirect()->back()->with('success', 'Structural audit enquiry submitted successfully.');
    }
}