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
public function store(Request $request)
{
    // dd($request);
    $vendorId = session('vendor_id');

    $validated = $request->validate([
        'project_types' => 'required|array',
        'project_types.*' => 'string',

        'experience_years' => 'required',
        'team_size' => 'required',
        'minimum_project_value' => 'required',
        'city' => 'required',
        'pincode' => 'required',

        'company_name' => 'required',
        'entity_type' => 'required',
        'registered_address' => 'required',
        'contact_person_name' => 'required',
        'contact_person_designation' => 'required',

        'pan_card' => 'nullable|file',
        'gst_certificate' => 'nullable|file',
        'aadhaar_card' => 'nullable|file',
        'company_profile' => 'nullable|file',
        'license_certificate' => 'nullable|file',
        'previous_project_photos' => 'nullable|file',
    ]);

    // ✅ THIS IS MAIN LINE (IF EXIST UPDATE ELSE CREATE)
    $provider = SurveyorProvider::firstOrNew(['vendor_id' => $vendorId]);

    // ===== NORMAL DATA =====
    $provider->vendor_id = $vendorId;
    $provider->project_types = $validated['project_types'];
    $provider->experience_years = $validated['experience_years'];
    $provider->team_size = $validated['team_size'];
    $provider->minimum_project_value = $validated['minimum_project_value'];
    $provider->pincode = $validated['pincode'];
    $provider->city = $validated['city'];

    $provider->company_name = $validated['company_name'];
    $provider->entity_type = $validated['entity_type'];
    $provider->registered_address = $validated['registered_address'];
    $provider->contact_person_name = $validated['contact_person_name'];
    $provider->contact_person_designation = $validated['contact_person_designation'];

    // ===== FILES =====
    if ($request->hasFile('pan_card')) {
        $provider->pan_card = $request->file('pan_card')->store('surveyor/pan_card', 'public');
    }

    if ($request->hasFile('gst_certificate')) {
        $provider->gst_certificate = $request->file('gst_certificate')->store('surveyor/gst', 'public');
    }

    if ($request->hasFile('aadhaar_card')) {
        $provider->aadhaar_card = $request->file('aadhaar_card')->store('surveyor/aadhaar', 'public');
    }

    if ($request->hasFile('company_profile')) {
        $provider->company_profile = $request->file('company_profile')->store('surveyor/company_profile', 'public');
    }

    if ($request->hasFile('license_certificate')) {
        $provider->license_certificate = $request->file('license_certificate')->store('surveyor/license', 'public');
    }

    if ($request->hasFile('previous_project_photos')) {
        $provider->previous_project_photos = $request->file('previous_project_photos')->store('surveyor/project_photos', 'public');
    }

    $provider->status = 'pending';

    $provider->save();

    return back()->with('success', 'Saved Successfully');
}
}