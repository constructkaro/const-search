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
//     public function store(Request $request)
// {
//     // dd($request);
//     $validated = $request->validate([
//         'project_types' => 'required|array',
        
//         'experience_years' => 'required',
//         'team_size' => 'required',
//         'city_ids' => 'required',
//         'area_ids' => 'required|array',
//         'pincode' => 'required|string',
//         'minimum_project_value' => 'required',
//         'boq_turnaround_time' => 'required|string',
//         'gst_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
//         'aadhar_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
//         'company_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
//          'agreement_terms_accepted' => 'required|accepted',
//             'privacy_policy_accepted'  => 'required|accepted',
//             'newsletter_opt_in'        => 'nullable',
//             'agreement_accepted_at'    => 'nullable|string',
//     ]);

//     $vendorId = session('vendor_id');

//     if (!$vendorId) {
//         return back()->with('error', 'Vendor ID not found in session.');
//     }

//     $profile = VendorBoqProfile::firstOrNew(['vendor_id' => $vendorId]);

//     $profile->vendor_id = $vendorId;
//     $profile->project_types = $validated['project_types'];
//     $profile->experience_years = $validated['experience_years'];
//     $profile->team_size = $validated['team_size'];
//     $profile->city_ids = $validated['city_ids'];
//     $profile->area_ids = $validated['area_ids'];
//     $profile->pincode = $validated['pincode'];
//     $profile->minimum_project_value = $validated['minimum_project_value'];
//     $profile->boq_turnaround_time = $validated['boq_turnaround_time'];

//     $profile->agreement_terms_accepted = $validated['agreement_terms_accepted'];
//     $profile->privacy_policy_accepted = $validated['privacy_policy_accepted'];
//     $profile->newsletter_opt_in = $validated['newsletter_opt_in'];
//     $profile->agreement_accepted_at = $validated['agreement_accepted_at'];


//     if ($request->hasFile('gst_certificate')) {
//         $profile->gst_certificate = $request->file('gst_certificate')->store('vendor/boq/gst', 'public');
//     }

//     if ($request->hasFile('aadhar_card')) {
//         $profile->aadhar_card = $request->file('aadhar_card')->store('vendor/boq/aadhar', 'public');
//     }

//     if ($request->hasFile('company_profile')) {
//         $profile->company_profile = $request->file('company_profile')->store('vendor/boq/company-profile', 'public');
//     }

//     $profile->save();

//     return back()->with('success', 'BOQ profile saved successfully.');
// }

public function store(Request $request)
    {
        $validated = $request->validate([
            'project_types' => 'required|array|min:1',
            'project_types.*' => 'string',

            'experience_years' => 'required',
            'team_size' => 'required',

            'city_ids' => 'required|array|min:1',
            'area_ids' => 'required|array|min:1',
            'pincode' => 'required|string',

            'minimum_project_value' => 'required|numeric|min:0',
            'boq_turnaround_time' => 'required|string',

            'gst_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
            'aadhar_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
            'company_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',

            // Agreement is optional for normal Save / Update
            'agreement_terms_accepted' => 'nullable',
            'privacy_policy_accepted' => 'nullable',
            'newsletter_opt_in' => 'nullable',
            'agreement_accepted_at' => 'nullable|string',
        ]);

        $vendorId = session('vendor_id');

        if (!$vendorId) {
            return back()->with('error', 'Vendor ID not found in session.');
        }

        $profile = VendorBoqProfile::firstOrNew([
            'vendor_id' => $vendorId,
        ]);

        $profile->vendor_id = $vendorId;
        $profile->project_types = $validated['project_types'];
        $profile->experience_years = $validated['experience_years'];
        $profile->team_size = $validated['team_size'];
        $profile->city_ids = $validated['city_ids'];
        $profile->area_ids = $validated['area_ids'];
        $profile->pincode = $validated['pincode'];
        $profile->minimum_project_value = $validated['minimum_project_value'];
        $profile->boq_turnaround_time = $validated['boq_turnaround_time'];

        /*
        |--------------------------------------------------------------------------
        | Agreement Save Logic
        |--------------------------------------------------------------------------
        | If user accepted agreement, update agreement fields.
        | If user only clicked Save & Continue, keep existing agreement values as-is.
        */
        if ($request->input('agreement_terms_accepted') == '1' && $request->input('privacy_policy_accepted') == '1') {
            $profile->agreement_terms_accepted = 1;
            $profile->privacy_policy_accepted = 1;
            $profile->newsletter_opt_in = $request->input('newsletter_opt_in') == '1' ? 1 : 0;
            $profile->agreement_accepted_at = $request->input('agreement_accepted_at') ?: now();
        }

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