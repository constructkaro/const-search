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

        $vendorId = session('vendor_id');
        // dd($vendorId);
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
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return redirect()->route('login')->with('error', 'Please login first.');
    }

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

    dd(
    $request->all(),
    $request->hasFile('msme_certificate'),
    $request->hasFile('pan_card'),
    $request->hasFile('gst_certificate'),
    $request->hasFile('aadhaar_card'),
    $request->hasFile('company_profile'),
    $request->hasFile('pf_doc'),
    $request->hasFile('esic_doc'),
    $request->hasFile('work_photo_1'),
    $request->hasFile('work_photo_2'),
    $request->hasFile('work_photo_3')
);
    $existing = ContractorProvider::where('vendor_id', $vendorId)->first();

    $msme = $request->msme_registered === 'on' ? 'Yes' : $request->msme_registered;

    $msme_certificate = $existing->msme_certificate ?? null;
    if ($request->hasFile('msme_certificate')) {
        $msme_certificate = $request->file('msme_certificate')->store('contractors/msme_certificate', 'public');
    }

    $pan_card = $existing->pan_card ?? null;
    if ($request->hasFile('pan_card')) {
        $pan_card = $request->file('pan_card')->store('contractors/pan_card', 'public');
    }

    $gst_certificate = $existing->gst_certificate ?? null;
    if ($request->hasFile('gst_certificate')) {
        $gst_certificate = $request->file('gst_certificate')->store('contractors/gst_certificate', 'public');
    }

    $aadhaar_card = $existing->aadhaar_card ?? null;
    if ($request->hasFile('aadhaar_card')) {
        $aadhaar_card = $request->file('aadhaar_card')->store('contractors/aadhaar_card', 'public');
    }

    $company_profile = $existing->company_profile ?? null;
    if ($request->hasFile('company_profile')) {
        $company_profile = $request->file('company_profile')->store('contractors/company_profile', 'public');
    }

    $pf_doc = $existing->pf_doc ?? null;
    if ($request->hasFile('pf_doc')) {
        $pf_doc = $request->file('pf_doc')->store('contractors/pf_doc', 'public');
    }

    $esic_doc = $existing->esic_doc ?? null;
    if ($request->hasFile('esic_doc')) {
        $esic_doc = $request->file('esic_doc')->store('contractors/esic_doc', 'public');
    }

    $work_photo_1 = $existing->work_photo_1 ?? null;
    if ($request->hasFile('work_photo_1')) {
        $work_photo_1 = $request->file('work_photo_1')->store('contractors/work_photos', 'public');
    }

    $work_photo_2 = $existing->work_photo_2 ?? null;
    if ($request->hasFile('work_photo_2')) {
        $work_photo_2 = $request->file('work_photo_2')->store('contractors/work_photos', 'public');
    }

    $work_photo_3 = $existing->work_photo_3 ?? null;
    if ($request->hasFile('work_photo_3')) {
        $work_photo_3 = $request->file('work_photo_3')->store('contractors/work_photos', 'public');
    }

    $data = [
        'vendor_id' => $vendorId,
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
    ];

    if ($existing) {
        $existing->update($data);
        return back()->with('success', 'Data updated successfully');
    } else {
        ContractorProvider::create($data);
        return back()->with('success', 'Data saved successfully');
    }
}
   
    // public function store(Request $request)
    // {
       
    //      $vendorId = session('vendor_id');
    //     //  dd($vendorId);
    //     $request->validate([
    //         'project_types' => 'required|array',
    //         'company_name' => 'required|string|max:255',
    //         'msme_registered' => 'required',
    //         'pincode' => 'required',
    //         'msme_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
    //         'pan_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
    //         'gst_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
    //         'aadhaar_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
    //         'company_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
    //         'pf_doc' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
    //         'esic_doc' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
    //         'work_photo_1' => 'nullable|file|mimes:jpg,jpeg,png|max:20480',
    //         'work_photo_2' => 'nullable|file|mimes:jpg,jpeg,png|max:20480',
    //         'work_photo_3' => 'nullable|file|mimes:jpg,jpeg,png|max:20480',
    //     ]);

    //     $msme = $request->msme_registered === 'on' ? 'Yes' : $request->msme_registered;

    //     $msme_certificate = $request->hasFile('msme_certificate')
    //         ? $request->file('msme_certificate')->store('contractors/msme_certificate', 'public')
    //         : null;

    //     $pan_card = $request->hasFile('pan_card')
    //         ? $request->file('pan_card')->store('contractors/pan_card', 'public')
    //         : null;

    //     $gst_certificate = $request->hasFile('gst_certificate')
    //         ? $request->file('gst_certificate')->store('contractors/gst_certificate', 'public')
    //         : null;

    //     $aadhaar_card = $request->hasFile('aadhaar_card')
    //         ? $request->file('aadhaar_card')->store('contractors/aadhaar_card', 'public')
    //         : null;

    //     $company_profile = $request->hasFile('company_profile')
    //         ? $request->file('company_profile')->store('contractors/company_profile', 'public')
    //         : null;

    //     $pf_doc = $request->hasFile('pf_doc')
    //         ? $request->file('pf_doc')->store('contractors/pf_doc', 'public')
    //         : null;

    //     $esic_doc = $request->hasFile('esic_doc')
    //         ? $request->file('esic_doc')->store('contractors/esic_doc', 'public')
    //         : null;

    //     $work_photo_1 = $request->hasFile('work_photo_1')
    //         ? $request->file('work_photo_1')->store('contractors/work_photos', 'public')
    //         : null;

    //     $work_photo_2 = $request->hasFile('work_photo_2')
    //         ? $request->file('work_photo_2')->store('contractors/work_photos', 'public')
    //         : null;

    //     $work_photo_3 = $request->hasFile('work_photo_3')
    //         ? $request->file('work_photo_3')->store('contractors/work_photos', 'public')
    //         : null;

    //     ContractorProvider::create([
    //         'vendor_id' => $vendorId,
    //         'project_types' => $request->project_types,
    //         'experience_years' => $request->experience_years,
    //         'team_size' => $request->team_size,
    //         'city' => $request->city,
    //         'minimum_project_value' => $request->minimum_project_value,
    //         'pincode' => $request->pincode,
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

    //         'msme_certificate' => $msme_certificate,
    //         'pan_card' => $pan_card,
    //         'gst_certificate' => $gst_certificate,
    //         'aadhaar_card' => $aadhaar_card,
    //         'company_profile' => $company_profile,
    //         'pf_doc' => $pf_doc,
    //         'esic_doc' => $esic_doc,
    //         'work_photo_1' => $work_photo_1,
    //         'work_photo_2' => $work_photo_2,
    //         'work_photo_3' => $work_photo_3,

    //         'status' => 'pending',
    //     ]);

    //     return back()->with('success', 'Data saved successfully');
    // }
}