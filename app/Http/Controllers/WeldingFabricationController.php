<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeldingFabricationEnquiry;

class WeldingFabricationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category'                => 'nullable|string|max:100',
            'building_name'           => 'nullable|string|max:255',
            'road_name'               => 'nullable|string|max:255',
            'city'                    => 'nullable|string|max:100',
            'pincode'                 => 'nullable|string|max:20',
            'project_name'            => 'nullable|string|max:255',
            'project_area'            => 'nullable|string|max:100',
            'project_area_unit'       => 'nullable|string|max:50',
            'service_type_required'   => 'nullable|string|max:255',
            'service_model_required'  => 'nullable|string|max:255',
            'additional_details'      => 'nullable|string',
        ]);

        WeldingFabricationEnquiry::create([
            'category'               => $request->category,
            'building_name'          => $request->building_name,
            'road_name'              => $request->road_name,
            'city'                   => $request->city,
            'pincode'                => $request->pincode,
            'project_name'           => $request->project_name,
            'project_area'           => $request->project_area,
            'project_area_unit'      => $request->project_area_unit,
            'service_type_required'  => $request->service_type_required,
            'service_model_required' => $request->service_model_required,
            'additional_details'     => $request->additional_details,
        ]);

        return redirect()->back()->with('success_modal', true);
    }
}