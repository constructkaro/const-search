<?php

namespace App\Http\Controllers;

use App\Models\VendorBoqProfile;
use Illuminate\Http\Request;

class VendorBoqProfileController extends Controller
{
    public function create()
    {
        return view('vendor.forms.boq-form');
    }

  
    // public function store(Request $request)
    // {
    //     // dd($request);
    //     $validated = $request->validate([
    //         'project_types' => 'required|array|min:1',
    //         'project_types.*' => 'string',
    //         'boq_turnaround_time' => 'required|string',
    //         'city_id' => 'required',
    //         'area_ids' => 'required|array',
    //         'pincode' => 'required',
    //         'gst_certificate' => 'nullable',
    //         'aadhar_card' => 'nullable',
    //         'company_profile' => 'nullable',
    //     ]);

    //     $vendorId = session('vendor_id');

    //     // Check vendor id
    //     if (!$vendorId) {
    //         return back()->with('error', 'Vendor ID not found in session.');
    //     }

    //     $profile = VendorBoqProfile::where('vendor_id', $vendorId)->first();

    //     if (!$profile) {
    //         $profile = new VendorBoqProfile();
    //         $profile->vendor_id = $vendorId;
    //     }

    //     $profile->project_types = $validated['project_types'];
    //     $profile->boq_turnaround_time = $validated['boq_turnaround_time'];

    //     if ($request->hasFile('gst_certificate')) {
    //         $profile->gst_certificate = $request->file('gst_certificate')->store('vendor/boq/gst', 'public');
    //     }

    //     if ($request->hasFile('aadhar_card')) {
    //         $profile->aadhar_card = $request->file('aadhar_card')->store('vendor/boq/aadhar', 'public');
    //     }

    //     if ($request->hasFile('company_profile')) {
    //         $profile->company_profile = $request->file('company_profile')->store('vendor/boq/company-profile', 'public');
    //     }

    //      'city_id' => $request->city_id,
    //     'area_ids' => $request->area_ids,
    //     'pincode' => $request->pincode,
    //     'minimum_project_value' => $request->minimum_project_value,
    //     $profile->save();

    //     return back()->with('success', 'BOQ profile saved successfully.');
    // }
    public function store(Request $request)
{
    $validated = $request->validate([
        'project_types' => 'required|array',
        
        'experience_years' => 'required',
        'team_size' => 'required',
        'city_id' => 'required',
        'area_ids' => 'required|array',
        'pincode' => 'required|string',
        'minimum_project_value' => 'required',
        'boq_turnaround_time' => 'required|string',
        'gst_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        'aadhaar_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        'company_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
    ]);

    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return back()->with('error', 'Vendor ID not found in session.');
    }

    $profile = VendorBoqProfile::firstOrNew(['vendor_id' => $vendorId]);

    $profile->vendor_id = $vendorId;
    $profile->project_types = $validated['project_types'];
    $profile->experience_years = $validated['experience_years'];
    $profile->team_size = $validated['team_size'];
    $profile->city_id = $validated['city_id'];
    $profile->area_ids = $validated['area_ids'];
    $profile->pincode = $validated['pincode'];
    $profile->minimum_project_value = $validated['minimum_project_value'];
    $profile->boq_turnaround_time = $validated['boq_turnaround_time'];

    if ($request->hasFile('gst_certificate')) {
        $profile->gst_certificate = $request->file('gst_certificate')->store('vendor/boq/gst', 'public');
    }

    if ($request->hasFile('aadhaar_card')) {
        $profile->aadhaar_card = $request->file('aadhaar_card')->store('vendor/boq/aadhaar', 'public');
    }

    if ($request->hasFile('company_profile')) {
        $profile->company_profile = $request->file('company_profile')->store('vendor/boq/company-profile', 'public');
    }

    $profile->save();

    return back()->with('success', 'BOQ profile saved successfully.');
}
}