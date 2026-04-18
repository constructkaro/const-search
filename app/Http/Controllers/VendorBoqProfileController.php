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
    //         'project_types_handled' => 'required|array|min:1',
    //         'project_types_handled.*' => 'string',
    //         'boq_turnaround_time' => 'required|string',

    //         'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
    //         'aadhar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
    //         'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
    //     ], [
    //         'project_types_handled.required' => 'Please select at least one project type.',
    //         'boq_turnaround_time.required' => 'Please select BOQ turnaround time.',
    //     ]);

    //     $gstPath = $request->hasFile('gst_certificate')
    //         ? $request->file('gst_certificate')->store('vendor/boq/gst', 'public')
    //         : null;

    //     $aadharPath = $request->hasFile('aadhar_card')
    //         ? $request->file('aadhar_card')->store('vendor/boq/aadhar', 'public')
    //         : null;

    //     $companyProfilePath = $request->hasFile('company_profile')
    //         ? $request->file('company_profile')->store('vendor/boq/company-profile', 'public')
    //         : null;

    //     VendorBoqProfile::create([
    //         'vendor_id' => session('vendor_id'), // optional
    //         'project_types_handled' => $validated['project_types_handled'],
    //         'boq_turnaround_time' => $validated['boq_turnaround_time'],
    //         'gst_certificate' => $gstPath,
    //         'aadhar_card' => $aadharPath,
    //         'company_profile' => $companyProfilePath,
    //     ]);

    //     return redirect()->back()->with('success', 'BOQ profile form submitted successfully.');
    // }

//     public function store(Request $request)
// {
//     // dd($request->all(), $request->file());

//     $validated = $request->validate([
//         'project_types' => 'required|array|min:1',
//         'project_types.*' => 'string',
//         'boq_turnaround_time' => 'required|string',

//         'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
//         'aadhar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
//         'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
//     ], [
//         'project_types.required' => 'Please select at least one project type.',
//         'boq_turnaround_time.required' => 'Please select BOQ turnaround time.',
//     ]);

//     $gstPath = $request->hasFile('gst_certificate')
//         ? $request->file('gst_certificate')->store('vendor/boq/gst', 'public')
//         : null;

//     $aadharPath = $request->hasFile('aadhar_card')
//         ? $request->file('aadhar_card')->store('vendor/boq/aadhar', 'public')
//         : null;

//     $companyProfilePath = $request->hasFile('company_profile')
//         ? $request->file('company_profile')->store('vendor/boq/company-profile', 'public')
//         : null;

//     VendorBoqProfile::create([
//         'vendor_id' => session('vendor_id'),
//         'project_types' => $validated['project_types'], // map form field to DB column
//         'boq_turnaround_time' => $validated['boq_turnaround_time'],
//         'gst_certificate' => $gstPath,
//         'aadhar_card' => $aadharPath,
//         'company_profile' => $companyProfilePath,
//     ]);

//     return redirect()->back()->with('success', 'BOQ profile form submitted successfully.');
// }
public function store(Request $request)
{
    // dd($request);
    $validated = $request->validate([
        'project_types' => 'required|array|min:1',
        'project_types.*' => 'string',
        'boq_turnaround_time' => 'required|string',

        'gst_certificate' => 'nullable',
        'aadhar_card' => 'nullable',
        'company_profile' => 'nullable',
    ]);

    $vendorId = session('vendor_id');

    // Check vendor id
    if (!$vendorId) {
        return back()->with('error', 'Vendor ID not found in session.');
    }

    $profile = VendorBoqProfile::where('vendor_id', $vendorId)->first();

    if (!$profile) {
        $profile = new VendorBoqProfile();
        $profile->vendor_id = $vendorId;
    }

    $profile->project_types = $validated['project_types'];
    $profile->boq_turnaround_time = $validated['boq_turnaround_time'];

    if ($request->hasFile('gst_certificate')) {
        $profile->gst_certificate = $request->file('gst_certificate')->store('vendor/boq/gst', 'public');
    }

    if ($request->hasFile('aadhar_card')) {
        $profile->aadhar_card = $request->file('aadhar_card')->store('vendor/boq/aadhar', 'public');
    }

    if ($request->hasFile('company_profile')) {
        $profile->company_profile = $request->file('company_profile')->store('vendor/boq/company-profile', 'public');
    }

    $profile->save();

    return back()->with('success', 'BOQ profile saved successfully.');
}
}