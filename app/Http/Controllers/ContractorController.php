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

        'city_ids' => 'required|array|min:1',
        'city_ids.*' => 'required',

        'area_ids' => 'required|array|min:1',
        'area_ids.*' => 'required',

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

    $existing = ContractorProvider::where('vendor_id', $vendorId)->first();

    $uploadFile = function ($field, $folder) use ($request, $existing) {
        if ($request->hasFile($field)) {
            return $request->file($field)->store($folder, 'public');
        }

        if ($existing) {
            return $existing->$field;
        }

        return null;
    };

    // Agreement simple 1 and 0
    $termsAccepted = $request->input('agreement_terms_accepted') == '1' ? 1 : 0;
    $privacyAccepted = $request->input('privacy_policy_accepted') == '1' ? 1 : 0;
    $newsletterOptIn = $request->input('newsletter_opt_in') == '1' ? 1 : 0;

    $agreementAcceptedAt = null;

    if ($termsAccepted == 1 && $privacyAccepted == 1) {
        if ($existing && !empty($existing->agreement_accepted_at)) {
            $agreementAcceptedAt = $existing->agreement_accepted_at;
        } else {
            $agreementAcceptedAt = date('Y-m-d H:i:s');
        }
    }

    $data = [
        'vendor_id' => $vendorId,

        'project_types' => $request->project_types,
        'experience_years' => $request->experience_years,
        'team_size' => $request->team_size,

        'city_ids' => $request->city_ids,
        'area_ids' => $request->area_ids,
        'pincode' => $request->pincode,

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

        'msme_registered' => $request->msme_registered,

        'msme_certificate' => $uploadFile('msme_certificate', 'contractors/msme_certificate'),
        'pan_card' => $uploadFile('pan_card', 'contractors/pan_card'),
        'gst_certificate' => $uploadFile('gst_certificate', 'contractors/gst_certificate'),
        'aadhaar_card' => $uploadFile('aadhaar_card', 'contractors/aadhaar_card'),
        'company_profile' => $uploadFile('company_profile', 'contractors/company_profile'),
        'pf_doc' => $uploadFile('pf_doc', 'contractors/pf_doc'),
        'esic_doc' => $uploadFile('esic_doc', 'contractors/esic_doc'),

        'work_photo_1' => $uploadFile('work_photo_1', 'contractors/work_photos'),
        'work_photo_2' => $uploadFile('work_photo_2', 'contractors/work_photos'),
        'work_photo_3' => $uploadFile('work_photo_3', 'contractors/work_photos'),

        'agreement_terms_accepted' => $termsAccepted,
        'privacy_policy_accepted' => $privacyAccepted,
        'newsletter_opt_in' => $newsletterOptIn,
        'agreement_accepted_at' => $agreementAcceptedAt,

        'status' => 'pending',
    ];

    if ($existing) {
        $existing->update($data);

        return back()->with('success', 'Contractor profile updated successfully.');
    }

    ContractorProvider::create($data);

    return back()->with('success', 'Contractor profile saved successfully.');
}

public function acceptContractorAgreement(Request $request)
{
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return response()->json([
            'status' => false,
            'message' => 'Please login first.'
        ], 401);
    }

    $existing = ContractorProvider::where('vendor_id', $vendorId)->first();

    if (!$existing) {
        return response()->json([
            'status' => false,
            'message' => 'Please submit your contractor profile first, then accept agreement.'
        ], 422);
    }

    $existing->agreement_terms_accepted = 1;
    $existing->privacy_policy_accepted = 1;
    $existing->newsletter_opt_in = $request->newsletter_opt_in == 1 ? 1 : 0;

    if (empty($existing->agreement_accepted_at)) {
        $existing->agreement_accepted_at = date('Y-m-d H:i:s');
    }

    $existing->save();

    return response()->json([
        'status' => true,
        'message' => 'Agreement accepted successfully.',
        'accepted_at' => $existing->agreement_accepted_at
    ]);
}

//     public function store(Request $request)
// {
//     dd($request);
//     $vendorId = session('vendor_id');

//     if (!$vendorId) {
//         return redirect()->route('login')->with('error', 'Please login first.');
//     }

//     $request->validate([
//         'project_types' => 'required|array',
//         'company_name' => 'required|string|max:255',
//         'msme_registered' => 'required',

//         'city_ids' => 'required|array|min:1',
//         'city_ids.*' => 'required',

//         'area_ids' => 'required|array|min:1',
//         'area_ids.*' => 'required',

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

//     $existing = ContractorProvider::where('vendor_id', $vendorId)->first();

//     // Simple file upload helper
//     $uploadFile = function ($field, $folder) use ($request, $existing) {
//         if ($request->hasFile($field)) {
//             return $request->file($field)->store($folder, 'public');
//         }

//         return $existing->$field ?? null;
//     };

//     // Simple 1 / 0 agreement values
//     $termsAccepted = $request->input('agreement_terms_accepted') == 1 ? 1 : 0;
//     $privacyAccepted = $request->input('privacy_policy_accepted') == 1 ? 1 : 0;
//     $newsletterOptIn = $request->input('newsletter_opt_in') == 1 ? 1 : 0;

//     $agreementAcceptedAt = null;

//     if ($termsAccepted == 1 && $privacyAccepted == 1) {
//         $agreementAcceptedAt = $existing && $existing->agreement_accepted_at
//             ? $existing->agreement_accepted_at
//             : date('Y-m-d H:i:s');
//     }

//     $data = [
//         'vendor_id' => $vendorId,

//         'project_types' => $request->project_types,
//         'experience_years' => $request->experience_years,
//         'team_size' => $request->team_size,

//         'city_ids' => $request->city_ids,
//         'area_ids' => $request->area_ids,
//         'pincode' => $request->pincode,

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

//         'msme_registered' => $request->msme_registered,

//         'msme_certificate' => $uploadFile('msme_certificate', 'contractors/msme_certificate'),
//         'pan_card' => $uploadFile('pan_card', 'contractors/pan_card'),
//         'gst_certificate' => $uploadFile('gst_certificate', 'contractors/gst_certificate'),
//         'aadhaar_card' => $uploadFile('aadhaar_card', 'contractors/aadhaar_card'),
//         'company_profile' => $uploadFile('company_profile', 'contractors/company_profile'),
//         'pf_doc' => $uploadFile('pf_doc', 'contractors/pf_doc'),
//         'esic_doc' => $uploadFile('esic_doc', 'contractors/esic_doc'),

//         'work_photo_1' => $uploadFile('work_photo_1', 'contractors/work_photos'),
//         'work_photo_2' => $uploadFile('work_photo_2', 'contractors/work_photos'),
//         'work_photo_3' => $uploadFile('work_photo_3', 'contractors/work_photos'),

//         'agreement_terms_accepted' => $termsAccepted,
//         'privacy_policy_accepted' => $privacyAccepted,
//         'newsletter_opt_in' => $newsletterOptIn,
//         'agreement_accepted_at' => $agreementAcceptedAt,

//         'status' => 'pending',
//     ];

//     if ($existing) {
//         $existing->update($data);
//         return back()->with('success', 'Contractor profile updated successfully.');
//     }

//     ContractorProvider::create($data);

//     return back()->with('success', 'Contractor profile saved successfully.');
// }
   
    // public function store(Request $request)
    // {
    //     // dd($request);
    //     $vendorId = session('vendor_id');

    //     if (!$vendorId) {
    //         return redirect()->route('login')->with('error', 'Please login first.');
    //     }



    //     $request->validate([
    //         'project_types' => 'required|array',
    //         'company_name' => 'required|string|max:255',
    //         'msme_registered' => 'required',

    //         'city_ids' => 'required|array|min:1',
    //         'city_ids.*' => 'required',

    //         'area_ids' => 'required|array|min:1',
    //         'area_ids.*' => 'required',

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

    //         'agreement_terms_accepted' => 'nullable',
    //         'privacy_policy_accepted'  => 'nullable',
    //         'newsletter_opt_in'        => 'nullable',
    //         'agreement_accepted_at'    => 'nullable|string',
    //     ]);

    //     $existing = ContractorProvider::where('vendor_id', $vendorId)->first();

    //     $msme = $request->msme_registered === 'on' ? 'Yes' : $request->msme_registered;

    //     $msme_certificate = $existing->msme_certificate ?? null;
    //     if ($request->hasFile('msme_certificate')) {
    //         $msme_certificate = $request->file('msme_certificate')->store('contractors/msme_certificate', 'public');
    //     }

    //     $pan_card = $existing->pan_card ?? null;
    //     if ($request->hasFile('pan_card')) {
    //         $pan_card = $request->file('pan_card')->store('contractors/pan_card', 'public');
    //     }

    //     $gst_certificate = $existing->gst_certificate ?? null;
    //     if ($request->hasFile('gst_certificate')) {
    //         $gst_certificate = $request->file('gst_certificate')->store('contractors/gst_certificate', 'public');
    //     }

    //     $aadhaar_card = $existing->aadhaar_card ?? null;
    //     if ($request->hasFile('aadhaar_card')) {
    //         $aadhaar_card = $request->file('aadhaar_card')->store('contractors/aadhaar_card', 'public');
    //     }

    //     $company_profile = $existing->company_profile ?? null;
    //     if ($request->hasFile('company_profile')) {
    //         $company_profile = $request->file('company_profile')->store('contractors/company_profile', 'public');
    //     }

    //     $pf_doc = $existing->pf_doc ?? null;
    //     if ($request->hasFile('pf_doc')) {
    //         $pf_doc = $request->file('pf_doc')->store('contractors/pf_doc', 'public');
    //     }

    //     $esic_doc = $existing->esic_doc ?? null;
    //     if ($request->hasFile('esic_doc')) {
    //         $esic_doc = $request->file('esic_doc')->store('contractors/esic_doc', 'public');
    //     }

    //     $work_photo_1 = $existing->work_photo_1 ?? null;
    //     if ($request->hasFile('work_photo_1')) {
    //         $work_photo_1 = $request->file('work_photo_1')->store('contractors/work_photos', 'public');
    //     }

    //     $work_photo_2 = $existing->work_photo_2 ?? null;
    //     if ($request->hasFile('work_photo_2')) {
    //         $work_photo_2 = $request->file('work_photo_2')->store('contractors/work_photos', 'public');
    //     }

    //     $work_photo_3 = $existing->work_photo_3 ?? null;
    //     if ($request->hasFile('work_photo_3')) {
    //         $work_photo_3 = $request->file('work_photo_3')->store('contractors/work_photos', 'public');
    //     }

    //     $data = [
    //         'vendor_id' => $vendorId,

    //         'project_types' => $request->project_types,
    //         'experience_years' => $request->experience_years,
    //         'team_size' => $request->team_size,

    //         'city_ids' => $request->city_ids,
    //         'area_ids' => $request->area_ids,
    //         'pincode' => $request->pincode,

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

    //         'agreement_terms_accepted' => $request->agreement_terms_accepted,
    //         'privacy_policy_accepted'  => $request->privacy_policy_accepted,
    //         'newsletter_opt_in'        => $request->newsletter_opt_in ?? 0,
    //         'agreement_accepted_at'    => $request->agreement_accepted_at,
    //     ];

    //     if ($existing) {
    //         $existing->update($data);
    //         return back()->with('success', 'Data updated successfully');
    //     }

    //     ContractorProvider::create($data);
    //     return back()->with('success', 'Data saved successfully');
    // }
}