<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ArchitectProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchitectController extends Controller
{
    public function create()
    {
        return view('vendor.category.architect-registration');
    }


    public function store(Request $request)
    {
        $request->validate([
            'project_types' => 'required|array',
            'company_name' => 'required',
        ]);

        ArchitectProvider::create([
            'project_types' => $request->project_types,
            'experience_years' => $request->experience_years,
            'team_size' => $request->team_size,
            'state' => $request->state,
            'region' => $request->region,
            'city' => $request->city,
            'minimum_project_value' => $request->minimum_project_value,

            'company_name' => $request->company_name,
            'entity_type' => $request->entity_type,
            'registered_address' => $request->registered_address,
            'contact_person_designation' => $request->contact_person_designation,
            'contact_person_name' => $request->contact_person_name,

            // ✅ ONLY VALID FIELDS
            'pan_number' => $request->pan_number,
            'gst_number' => $request->gst_number,   // <-- correct
            'coa_number' => $request->coa_number,   // <-- correct
            'website' => $request->website,

            'status' => 'pending',
        ]);

        return back()->with('success', 'Saved successfully');
    }

}