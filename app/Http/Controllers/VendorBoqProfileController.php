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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_types_handled' => 'required|array|min:1',
            'project_types_handled.*' => 'string',
            'boq_turnaround_time' => 'required|string',

            'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'aadhar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ], [
            'project_types_handled.required' => 'Please select at least one project type.',
            'boq_turnaround_time.required' => 'Please select BOQ turnaround time.',
        ]);

        $gstPath = $request->hasFile('gst_certificate')
            ? $request->file('gst_certificate')->store('vendor/boq/gst', 'public')
            : null;

        $aadharPath = $request->hasFile('aadhar_card')
            ? $request->file('aadhar_card')->store('vendor/boq/aadhar', 'public')
            : null;

        $companyProfilePath = $request->hasFile('company_profile')
            ? $request->file('company_profile')->store('vendor/boq/company-profile', 'public')
            : null;

        VendorBoqProfile::create([
            'vendor_id' => session('vendor_id'), // optional
            'project_types_handled' => $validated['project_types_handled'],
            'boq_turnaround_time' => $validated['boq_turnaround_time'],
            'gst_certificate' => $gstPath,
            'aadhar_card' => $aadharPath,
            'company_profile' => $companyProfilePath,
        ]);

        return redirect()->back()->with('success', 'BOQ profile form submitted successfully.');
    }
}