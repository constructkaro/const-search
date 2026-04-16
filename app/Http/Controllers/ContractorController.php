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
        // $customerId = session('customer_id');
        // dd($customerId);
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
 
    // public function store(Request $request)
    // {
    //     // dd($request);
    //     $customerId = session('customer_id');
    //     // dd($customerId);
    //     // SIMPLE VALIDATION
    //     $request->validate([
    //         'project_types' => 'required|array',
    //         'company_name' => 'required',
    //         'msme_registered' => 'required'
    //     ]);

    //     // FIX "on" VALUE FROM RADIO
    //     $msme = $request->msme_registered === 'on' ? 'Yes' : $request->msme_registered;

    //     // SAVE DATA
    //     ContractorProvider::create([
    //         'customerId' =>$customerId,
    //         'project_types' => $request->project_types, // cast handles array
    //         'experience_years' => $request->experience_years,
    //         'team_size' => $request->team_size,
            
    //         'city' => $request->city,
    //         'pincode' =>$request->pincode,
    //         'minimum_project_value' => $request->minimum_project_value,

    //         'company_name' => $request->company_name,
    //         'entity_type' => $request->entity_type,
    //         'registered_address' => $request->registered_address,
    //         'contact_person_designation' => $request->contact_person_designation,
    //         'contact_person_name' => $request->contact_person_name,

    //         'pan_number' => $request->pan_number,
    //         'tan_number' => $request->tan_number,
    //         'esic_number' => $request->esic_number,
    //         'pf_number' => $request->pf_number,

    //         'msme_registered' => $msme,

    //         'status' => 'pending',
    //     ]);

    //     return back()->with('success', 'Data saved successfully');
    // }

    public function store(Request $request)
    {
        $customerId = session('customer_id');

        // $request->validate([
        //     'project_types' => 'required|array',
        //     'company_name' => 'required|string|max:255',
        //     'msme_registered' => 'required',

        //     'msme_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        //     'pan_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        //     'gst_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        //     'aadhaar_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        //     'company_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        //     'pf_doc' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        //     'esic_doc' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        //     'work_photo_1' => 'nullable|file|mimes:jpg,jpeg,png|max:4096',
        //     'work_photo_2' => 'nullable|file|mimes:jpg,jpeg,png|max:4096',
        //     'work_photo_3' => 'nullable|file|mimes:jpg,jpeg,png|max:4096',
        // ]);
        $request->validate([
            'project_types' => 'required|array',
            'company_name' => 'required|string|max:255',
            'msme_registered' => 'required',
            'pincode' => 'required',
            'msme_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
            'pan_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
            'gst_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
            'aadhaar_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
            'company_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
            'pf_doc' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
            'esic_doc' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
            'work_photo_1' => 'nullable|file|mimes:jpg,jpeg,png|max:20480',
            'work_photo_2' => 'nullable|file|mimes:jpg,jpeg,png|max:20480',
            'work_photo_3' => 'nullable|file|mimes:jpg,jpeg,png|max:20480',
        ]);

        $msme = $request->msme_registered === 'on' ? 'Yes' : $request->msme_registered;

        $msme_certificate = $request->hasFile('msme_certificate')
            ? $request->file('msme_certificate')->store('contractors/msme_certificate', 'public')
            : null;

        $pan_card = $request->hasFile('pan_card')
            ? $request->file('pan_card')->store('contractors/pan_card', 'public')
            : null;

        $gst_certificate = $request->hasFile('gst_certificate')
            ? $request->file('gst_certificate')->store('contractors/gst_certificate', 'public')
            : null;

        $aadhaar_card = $request->hasFile('aadhaar_card')
            ? $request->file('aadhaar_card')->store('contractors/aadhaar_card', 'public')
            : null;

        $company_profile = $request->hasFile('company_profile')
            ? $request->file('company_profile')->store('contractors/company_profile', 'public')
            : null;

        $pf_doc = $request->hasFile('pf_doc')
            ? $request->file('pf_doc')->store('contractors/pf_doc', 'public')
            : null;

        $esic_doc = $request->hasFile('esic_doc')
            ? $request->file('esic_doc')->store('contractors/esic_doc', 'public')
            : null;

        $work_photo_1 = $request->hasFile('work_photo_1')
            ? $request->file('work_photo_1')->store('contractors/work_photos', 'public')
            : null;

        $work_photo_2 = $request->hasFile('work_photo_2')
            ? $request->file('work_photo_2')->store('contractors/work_photos', 'public')
            : null;

        $work_photo_3 = $request->hasFile('work_photo_3')
            ? $request->file('work_photo_3')->store('contractors/work_photos', 'public')
            : null;

        ContractorProvider::create([
            'customerId' => $customerId,
            'project_types' => $request->project_types,
            'experience_years' => $request->experience_years,
            'team_size' => $request->team_size,
            'city' => $request->city,
            'minimum_project_value' => $request->minimum_project_value,
            'pincode' => $request->pincode,
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

            'msme_certificate' => $msme_certificate,
            'pan_card' => $pan_card,
            'gst_certificate' => $gst_certificate,
            'aadhaar_card' => $aadhaar_card,
            'company_profile' => $company_profile,
            'pf_doc' => $pf_doc,
            'esic_doc' => $esic_doc,
            'work_photo_1' => $work_photo_1,
            'work_photo_2' => $work_photo_2,
            'work_photo_3' => $work_photo_3,

            'status' => 'pending',
        ]);

        return back()->with('success', 'Data saved successfully');
    }
}