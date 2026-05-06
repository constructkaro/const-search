<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SurveyorProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyorController extends Controller
{
    public function create()
    {
        return view('vendor.category.surveyor-registration');
    }

//    public function store(Request $request)
// {
//     $vendorId = session('vendor_id');
//     // check actual incoming data
//     dd($request->all());

//     $validated = $request->validate([
//         'project_types' => 'required|array',
//         'project_types.*' => 'string',

//         'experience_years' => 'required|string|max:100',
//         'team_size' => 'required|string|max:100',
//         'pan_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
//         'minimum_project_value' => 'required',
//         'city' => 'required|string|max:100',

//         'company_name' => 'required|string|max:255',
//         'entity_type' => 'required|string|max:100',
//         'registered_address' => 'required|string',
//         'contact_person_name' => 'required|string|max:150',
//         'contact_person_designation' => 'required|string|max:150',
//         'pincode'=>'required',
//         'licensed_surveyor' => 'nullable|in:Yes,No',
//         'stamped_drawings' => 'nullable|in:Yes,No',
//         'report_format_available' => 'nullable|in:Yes,No',
//         'land_record_support' => 'nullable|in:Yes,No',

//         'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
//         'aadhaar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
//         'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
//         'license_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
//         'previous_project_photos' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip|max:20480',
//     ]);

//       $pan_card = $existing->pan_card ?? null;
//     if ($request->hasFile('pan_card')) {
//         $pan_card = $request->file('pan_card')->store('contractors/pan_card', 'public');
//     }

//     $provider = new SurveyorProvider();
//     $provider->vendor_id = $vendorId;
//     $provider->pincode =$validated['pincode']; 
//     $provider->project_types = $validated['project_types']; // map project_types to survey_types column
//     $provider->experience_years = $validated['experience_years'];
//     $provider->team_size = $validated['team_size'];
//     $provider->minimum_project_value = $validated['minimum_project_value'];
//     $provider->pan_card = $validated['pan_card'];

   
//     $provider->city = $validated['city'];

//     $provider->company_name = $validated['company_name'];
//     $provider->entity_type = $validated['entity_type'];
//     $provider->registered_address = $validated['registered_address'];
//     $provider->contact_person_name = $validated['contact_person_name'];
//     $provider->contact_person_designation = $validated['contact_person_designation'];

//     $provider->licensed_surveyor = $validated['licensed_surveyor'] ?? null;
//     $provider->stamped_drawings = $validated['stamped_drawings'] ?? null;
//     $provider->report_format_available = $validated['report_format_available'] ?? null;
//     $provider->land_record_support = $validated['land_record_support'] ?? null;

//     if ($request->hasFile('gst_certificate')) {
//         $provider->gst_certificate = $request->file('gst_certificate')->store('surveyor/gst', 'public');
//     }

//     if ($request->hasFile('aadhaar_card')) {
//         $provider->aadhaar_card = $request->file('aadhaar_card')->store('surveyor/aadhaar', 'public');
//     }

//     if ($request->hasFile('company_profile')) {
//         $provider->company_profile = $request->file('company_profile')->store('surveyor/company_profile', 'public');
//     }

//     if ($request->hasFile('license_certificate')) {
//         $provider->license_certificate = $request->file('license_certificate')->store('surveyor/license', 'public');
//     }

//     if ($request->hasFile('previous_project_photos')) {
//         $provider->previous_project_photos = $request->file('previous_project_photos')->store('surveyor/project_photos', 'public');
//     }

//     $provider->status = 'pending';
//     $provider->save();

//     return redirect()->back()->with('success', 'Surveyor form submitted successfully.');
// }
// public function store(Request $request)
// {
//     // dd($request);
//     $vendorId = session('vendor_id');

//     // $validated = $request->validate([
//     //     'project_types' => 'required|array',
//     //     'project_types.*' => 'string',

//     //     'experience_years' => 'required',
//     //     'team_size' => 'required',
//     //     'minimum_project_value' => 'required',
//     //     'city_id' => 'required',
//     //     'pincode' => 'required',
//     //     'area_ids'=> 'required',
//     //     'company_name' => 'required',
//     //     'entity_type' => 'required',
//     //     'registered_address' => 'required',
//     //     'contact_person_name' => 'required',
//     //     'contact_person_designation' => 'required',

//     //     'pan_card' => 'nullable|file',
//     //     'gst_certificate' => 'nullable|file',
//     //     'aadhaar_card' => 'nullable|file',
//     //     'company_profile' => 'nullable|file',
//     //     'license_certificate' => 'nullable|file',
//     //     'previous_project_photos' => 'nullable|file',
//     // ]);
//     $validated = $request->validate([
//     'project_types' => 'required|array',
//     'project_types.*' => 'string',

//     'experience_years' => 'required',
//     'team_size' => 'required',
//     'minimum_project_value' => 'required',
//     'city_id' => 'required',
//     'pincode' => 'required',
//     'area_ids' => 'required|array',
//     'area_ids.*' => 'required',

//     'company_name' => 'required',
//     'entity_type' => 'required',
//     'registered_address' => 'required',
//     'contact_person_name' => 'required',
//     'contact_person_designation' => 'required',

//     'pan_card' => 'nullable|file',
//     'gst_certificate' => 'nullable|file',
//     'aadhaar_card' => 'nullable|file',
//     'company_profile' => 'nullable|file',
//     'license_certificate' => 'nullable|file',
//     'previous_project_photos' => 'nullable|file',
// ]);

//     // ✅ THIS IS MAIN LINE (IF EXIST UPDATE ELSE CREATE)
//     $provider = SurveyorProvider::firstOrNew(['vendor_id' => $vendorId]);

//     // ===== NORMAL DATA =====
//     $provider->vendor_id = $vendorId;
//     // $provider->project_types = $validated['project_types'];
//     $provider->project_types = json_encode($validated['project_types']);
//     $provider->experience_years = $validated['experience_years'];
//     $provider->team_size = $validated['team_size'];
//     $provider->minimum_project_value = $validated['minimum_project_value'];
//     $provider->pincode = $validated['pincode'];
//     $provider->city_id = $validated['city_id'];
//     // $provider->area_ids = $validated['area_ids'];
//     $provider->area_ids = json_encode($validated['area_ids']);
//     $provider->company_name = $validated['company_name'];
//     $provider->entity_type = $validated['entity_type'];
//     $provider->registered_address = $validated['registered_address'];
//     $provider->contact_person_name = $validated['contact_person_name'];
//     $provider->contact_person_designation = $validated['contact_person_designation'];

//     // ===== FILES =====
//     if ($request->hasFile('pan_card')) {
//         $provider->pan_card = $request->file('pan_card')->store('surveyor/pan_card', 'public');
//     }

//     if ($request->hasFile('gst_certificate')) {
//         $provider->gst_certificate = $request->file('gst_certificate')->store('surveyor/gst', 'public');
//     }

//     if ($request->hasFile('aadhaar_card')) {
//         $provider->aadhaar_card = $request->file('aadhaar_card')->store('surveyor/aadhaar', 'public');
//     }

//     if ($request->hasFile('company_profile')) {
//         $provider->company_profile = $request->file('company_profile')->store('surveyor/company_profile', 'public');
//     }

//     if ($request->hasFile('license_certificate')) {
//         $provider->license_certificate = $request->file('license_certificate')->store('surveyor/license', 'public');
//     }

//     if ($request->hasFile('previous_project_photos')) {
//         $provider->previous_project_photos = $request->file('previous_project_photos')->store('surveyor/project_photos', 'public');
//     }

//     $provider->status = 'pending';

//     $provider->save();

//     return back()->with('success', 'Saved Successfully');
// }
// public function store(Request $request)
// {
//     // dd($request);
//     $vendorId = session('vendor_id');

//     $request->validate([
//             'project_types' => 'required|array',
//             'company_name' => 'required|string|max:255',
           
//             'city_id' =>'required',
//             'area_ids' => 'required',
//             'pincode' => 'required',
           
//             'pan_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
//             'gst_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
//             'aadhaar_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
//             'company_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
           
//         ]);
//     $provider = SurveyorProvider::firstOrNew(['vendor_id' => $vendorId]);

   
//         $pan_card = $existing->pan_card ?? null;
//         if ($request->hasFile('pan_card')) {
//             $pan_card = $request->file('pan_card')->store('contractors/pan_card', 'public');
//         }

//         $gst_certificate = $existing->gst_certificate ?? null;
//         if ($request->hasFile('gst_certificate')) {
//             $gst_certificate = $request->file('gst_certificate')->store('contractors/gst_certificate', 'public');
//         }

//         $aadhaar_card = $existing->aadhaar_card ?? null;
//         if ($request->hasFile('aadhaar_card')) {
//             $aadhaar_card = $request->file('aadhaar_card')->store('contractors/aadhaar_card', 'public');
//         }

//         $company_profile = $existing->company_profile ?? null;
//         if ($request->hasFile('company_profile')) {
//             $company_profile = $request->file('company_profile')->store('contractors/company_profile', 'public');
//         }

     

//         $data = [
//             'vendor_id' => $vendorId,
//             'project_types' => $request->project_types,
//             'experience_years' => $request->experience_years,
//             'team_size' => $request->team_size,
//             'city_id' => $request->city_id,
//             'area_ids' => $request->area_ids,
//             'minimum_project_value' => $request->minimum_project_value,
//             'pincode' => $request->pincode,
//             'company_name' => $request->company_name,
//             'entity_type' => $request->entity_type,
//             'registered_address' => $request->registered_address,
//             'contact_person_designation' => $request->contact_person_designation,
//             'contact_person_name' => $request->contact_person_name,
//             'pan_number' => $request->pan_number,
         
//             'pan_card' => $pan_card,
//             'gst_certificate' => $gst_certificate,
//             'aadhaar_card' => $aadhaar_card,
//             'company_profile' => $company_profile,
           
//         ];

//         if ($existing) {
//             $existing->update($data);
//             return back()->with('success', 'Data updated successfully');
//         } else {
//             SurveyorProvider::create($data);
//             return back()->with('success', 'Data saved successfully');
//         }
// }
public function store(Request $request)
{
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return redirect()->route('login')->with('error', 'Please login first.');
    }

    $request->validate([
        'project_types' => 'required|array',
      

        'company_name' => 'required|string|max:255',
        'city_ids' => 'required|array',
        'area_ids' => 'required|array',
      
        'pincode' => 'required',

        'pan_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        'gst_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        'aadhaar_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        'company_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        'agreement_terms_accepted' => 'nullable',
'privacy_policy_accepted'  => 'nullable',
'newsletter_opt_in'        => 'nullable',
'agreement_accepted_at'    => 'nullable',
    ]);


    $existing = SurveyorProvider::where('vendor_id', $vendorId)->first();

    $pan_card = $existing->pan_card ?? null;
    if ($request->hasFile('pan_card')) {
        $pan_card = $request->file('pan_card')->store('surveyor/pan_card', 'public');
    }

    $gst_certificate = $existing->gst_certificate ?? null;
    if ($request->hasFile('gst_certificate')) {
        $gst_certificate = $request->file('gst_certificate')->store('surveyor/gst_certificate', 'public');
    }

    $aadhaar_card = $existing->aadhaar_card ?? null;
    if ($request->hasFile('aadhaar_card')) {
        $aadhaar_card = $request->file('aadhaar_card')->store('surveyor/aadhaar_card', 'public');
    }

    $company_profile = $existing->company_profile ?? null;
    if ($request->hasFile('company_profile')) {
        $company_profile = $request->file('company_profile')->store('surveyor/company_profile', 'public');
    }

    $data = [
        'vendor_id' => $vendorId,
         'project_types' => $request->project_types,
        'experience_years' => $request->experience_years,
        'team_size' => $request->team_size,
        'city_ids' => $request->city_ids,
         'area_ids' => $request->area_ids,
        'minimum_project_value' => $request->minimum_project_value,
        'pincode' => $request->pincode,
        'company_name' => $request->company_name,
        'entity_type' => $request->entity_type,
        'registered_address' => $request->registered_address,
        'contact_person_designation' => $request->contact_person_designation,
        'contact_person_name' => $request->contact_person_name,
        'pan_number' => $request->pan_number,
        'pan_card' => $pan_card,
        'gst_certificate' => $gst_certificate,
        'aadhaar_card' => $aadhaar_card,
        'company_profile' => $company_profile,
        'status' => 'pending',
        'agreement_terms_accepted' => $request->agreement_terms_accepted,
'privacy_policy_accepted'  => $request->privacy_policy_accepted,
'newsletter_opt_in'        => $request->newsletter_opt_in,
'agreement_accepted_at'    => $request->agreement_accepted_at,
    ];

    if ($existing) {
        $existing->update($data);
        return back()->with('success', 'Data updated successfully');
    } else {
        SurveyorProvider::create($data);
        return back()->with('success', 'Data saved successfully');
    }
}
}