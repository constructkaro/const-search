<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContractorProvider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractorController extends Controller
{
 
    public function create()
    {
        $workType = DB::table('work_types')
            ->where('work_type', 'Contractor')
            ->first();

        $projectTypes = collect();

        if ($workType) {
            $projectTypes = DB::table('work_subtypes')
                ->where('work_type_id', $workType->id)
                ->orderBy('work_subtype', 'asc')
                ->pluck('work_subtype');
        }

        return view('vendor.categories.contractor', compact('workType', 'projectTypes'));
    }
 
    public function store(Request $request)
    {
        // SIMPLE VALIDATION
        $request->validate([
            'project_types' => 'required|array',
            'company_name' => 'required',
            'msme_registered' => 'required'
        ]);

        // FIX "on" VALUE FROM RADIO
        $msme = $request->msme_registered === 'on' ? 'Yes' : $request->msme_registered;

        // SAVE DATA
        ContractorProvider::create([
            'project_types' => $request->project_types, // cast handles array
            'experience_years' => $request->experience_years,
            'team_size' => $request->team_size,
            
            'city' => $request->city,
            'pincode' =>$request->pincode,
            'minimum_project_value' => $request->minimum_project_value,

            'company_name' => $request->company_name,
            'entity_type' => $request->entity_type,
            'registered_address' => $request->registered_address,
            'contact_person_designation' => $request->contact_person_designation,
            'contact_person_name' => $request->contact_person_name,

            'pan_number' => $request->pan_number,
            'tan_number' => $request->tan_number,
            'esic_number' => $request->esic_number,
            'pf_number' => $request->pf_number,

            'msme_registered' => $msme,

            'status' => 'pending',
        ]);

        return back()->with('success', 'Data saved successfully');
    }
}