<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoqEnquiryController extends Controller
{
    public function store(Request $request)
    {
        $customerId = session('customer_id');
        $request->validate([
           
            'package_name'            => 'required|string|max:255',
            'house_building_name'     => 'required|string|max:255',
            'road_area_colony'        => 'nullable|string|max:255',
            'city'                    => 'required|string|max:100',
            'pincode'                 => 'required|digits:6',
            'project_name'            => 'required|string|max:255',
            'no_of_floors'            => 'nullable|integer|min:0',
            'project_area'            => 'required|string|max:100',
            'unit'                    => 'required|string|max:50',
            'project_type'            => 'required|string|max:100',
            'service_required'        => 'required|string|max:100',
            'scope_of_work_required'  => 'required|string|max:100',
            'drawing_availability'    => 'required|string|max:50',
            'drawing_file'            => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,dwg|max:10240',
            'additional_details'      => 'nullable|string',
        ]);

        $drawingFilePath = null;

        if ($request->hasFile('drawing_file')) {
            $drawingFilePath = $request->file('drawing_file')->store('boq_drawings', 'public');
        }

        DB::table('boq_enquiries')->insert([
             'customerId'              => $customerId,
            'package_name'            => $request->package_name,
            'house_building_name'     => $request->house_building_name,
            'road_area_colony'        => $request->road_area_colony,
            'city'                    => $request->city,
            'pincode'                 => $request->pincode,
            'project_name'            => $request->project_name,
            'no_of_floors'            => $request->no_of_floors,
            'project_area'            => $request->project_area,
            'unit'                    => $request->unit,
            'project_type'            => $request->project_type,
            'service_required'        => $request->service_required,
            'scope_of_work_required'  => $request->scope_of_work_required,
            'drawing_availability'    => $request->drawing_availability,
            'drawing_file'            => $drawingFilePath,
            'additional_details'      => $request->additional_details,
            'created_at'              => now(),
            'updated_at'              => now(),
        ]);

        return redirect()->back()->with('success', 'BOQ enquiry submitted successfully.');
    }
}