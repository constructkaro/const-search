<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestingEnquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_name'          => 'required|string|max:255',
            'house_building_name'   => 'required|string|max:255',
            'road_area_colony'      => 'nullable|string|max:255',
            'city'                  => 'required|string|max:100',
            'pincode'               => 'required|digits:6',
            'project_name'          => 'required|string|max:255',
            'number_of_samples'     => 'required|integer|min:1',
            'required_testing_type' => 'required|string|max:255',
            'additional_details'    => 'nullable|string',
        ]);

        DB::table('testing_enquiries')->insert([
            'service_name'          => $request->service_name,
            'house_building_name'   => $request->house_building_name,
            'road_area_colony'      => $request->road_area_colony,
            'city'                  => $request->city,
            'pincode'               => $request->pincode,
            'project_name'          => $request->project_name,
            'number_of_samples'     => $request->number_of_samples,
            'required_testing_type' => $request->required_testing_type,
            'additional_details'    => $request->additional_details,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);

        return redirect()->back()->with('success', 'Testing enquiry submitted successfully.');
    }
}