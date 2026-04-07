<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NaSupportEnquiry;

class NaSupportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'building_name'         => 'nullable|string|max:255',
            'road_name'             => 'nullable|string|max:255',
            'city'                  => 'nullable|string|max:255',
            'pincode'               => 'nullable|string|max:20',
            'project_name'          => 'required|string|max:255',
            'land_status'           => 'nullable|string|max:100',
            'project_area'          => 'nullable|string|max:100',
            'project_area_unit'     => 'nullable|string|max:50',
            'complete_na_process'   => 'nullable|string|in:yes,no',
            'legal_opinion_report'  => 'nullable|string|in:yes,no',
            'advocate_coordinate'   => 'nullable|string|in:yes,no',
            'additional_details'    => 'nullable|string',
        ]);

        NaSupportEnquiry::create([
            'building_name'         => $request->building_name,
            'road_name'             => $request->road_name,
            'city'                  => $request->city,
            'pincode'               => $request->pincode,
            'project_name'          => $request->project_name,
            'land_status'           => $request->land_status,
            'project_area'          => $request->project_area,
            'project_area_unit'     => $request->project_area_unit,
            'complete_na_process'   => $request->complete_na_process,
            'legal_opinion_report'  => $request->legal_opinion_report,
            'advocate_coordinate'   => $request->advocate_coordinate,
            'additional_details'    => $request->additional_details,
        ]);

        return redirect()->back()->with('success_modal', true);
    }
}