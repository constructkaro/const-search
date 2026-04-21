<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestingService;

class TestingController extends Controller
{
   
    // public function store(Request $request)
    // {
    //     // dd($request);
    //     $vendorId = session('vendor_id');

    //     if (!$vendorId) {
    //         dd('Vendor ID missing in session');
    //     }

    //     // Validate
    //     $request->validate([
    //         'services' => 'nullable|array',
    //         'lab_type' => 'nullable|string',
    //         'service_mode' => 'nullable|array',
    //         'certification' => 'nullable|string',
    //          'team_size' => 'required',
    //     'city_id' => 'required',
    //     'area_ids' => 'required|array',
    //     'pincode' => 'required|string',
    //     'minimum_project_value' => 'required',
    //     ]);

    //     // File upload helper
    //     $uploadFile = function ($inputName) use ($request) {
    //         if ($request->hasFile($inputName)) {
    //             return $request->file($inputName)->store('testing_services', 'public');
    //         }
    //         return null;
    //     };

    //     // Upload files
    //     $gstCertificate = $uploadFile('gst_certificate');
    //     $aadhaarCard = $uploadFile('aadhaar_card');
    //     $companyProfile = $uploadFile('company_profile');
    //     $nablCertificate = $uploadFile('nabl_certificate');
    //     $accreditationCertificate = $uploadFile('accreditation_certificate');

    //     // Multiple photos
    //     $labPhotos = [];
    //     if ($request->hasFile('lab_photos')) {
    //         foreach ($request->file('lab_photos') as $photo) {
    //             $labPhotos[] = $photo->store('testing_services/lab_photos', 'public');
    //         }
    //     }

    //     // 🔥 IMPORTANT: SAVE DATA
    //     $data = [
    //         'vendor_id' => $vendorId,
    //         'services' => json_encode($request->services),
    //         'lab_type' => $request->lab_type,
    //         'certification' => $request->certification,
    //         'service_mode' => json_encode($request->service_mode),
    //         'sample_pickup_available' => $request->has('sample_pickup_available') ? 1 : 0,
    //         'gst_certificate' => $gstCertificate,
    //          'team_size' => $request->team_size,
    //          'city_id' => $request->city_id,'area_ids' => $request->area_ids,
    //          'pincode' => $request->pincode,'minimum_project_value' => $request->minimum_project_value,
            
    //         'aadhaar_card' => $aadhaarCard,
    //         'company_profile' => $companyProfile,
    //         'nabl_certificate' => $nablCertificate,
    //         'lab_photos' => json_encode($labPhotos),
    //         'accreditation_certificate' => $accreditationCertificate,
    //     ];

    //     // 🔥 DEBUG BEFORE SAVE
    //     // dd($data);

    //     // SAVE
    //     TestingService::updateOrCreate(
    //         ['vendor_id' => $vendorId],
    //         $data
    //     );

    //     return back()->with('success', 'Saved successfully');
    // }
    public function store(Request $request)
{
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return back()->with('error', 'Vendor ID missing in session');
    }

    $request->validate([
        'services' => 'nullable|array',
        'lab_type' => 'nullable|string',
        'service_mode' => 'nullable|array',
        'certification' => 'nullable|string',
        'experience_years' => 'nullable',
        'team_size' => 'required',
        'city_id' => 'required',
        'area_ids' => 'required|array',
        'area_ids.*' => 'required',
        'pincode' => 'required|string',
        'minimum_project_value' => 'required',
        'gst_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        'aadhaar_card' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        'company_profile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        'nabl_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        'lab_photos.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
        'accreditation_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
    ]);

    $existing = TestingService::where('vendor_id', $vendorId)->first();

    $uploadFile = function ($inputName, $existingPath = null) use ($request) {
        if ($request->hasFile($inputName)) {
            return $request->file($inputName)->store('testing_services', 'public');
        }
        return $existingPath;
    };

    $gstCertificate = $uploadFile('gst_certificate', $existing->gst_certificate ?? null);
    $aadhaarCard = $uploadFile('aadhaar_card', $existing->aadhaar_card ?? null);
    $companyProfile = $uploadFile('company_profile', $existing->company_profile ?? null);
    $nablCertificate = $uploadFile('nabl_certificate', $existing->nabl_certificate ?? null);
    $accreditationCertificate = $uploadFile('accreditation_certificate', $existing->accreditation_certificate ?? null);

    $labPhotos = $existing && !empty($existing->lab_photos)
        ? (is_array($existing->lab_photos) ? $existing->lab_photos : json_decode($existing->lab_photos, true))
        : [];

    $labPhotos = is_array($labPhotos) ? $labPhotos : [];

    if ($request->hasFile('lab_photos')) {
        $labPhotos = [];
        foreach ($request->file('lab_photos') as $photo) {
            $labPhotos[] = $photo->store('testing_services/lab_photos', 'public');
        }
    }

    // $data = [
    //     'vendor_id' => $vendorId,
    //     'services' => json_encode($request->services ?? []),
    //     'lab_type' => $request->lab_type,
    //     'certification' => $request->certification,
    //     'service_mode' => json_encode($request->service_mode ?? []),
    //     'sample_pickup_available' => $request->has('sample_pickup_available') ? 1 : 0,
    //     'gst_certificate' => $gstCertificate,
    //     'experience_years' => $request->experience_years,
    //     'team_size' => $request->team_size,
    //     'city_id' => $request->city_id,
    //     'area_ids' => json_encode($request->area_ids),
    //     'pincode' => $request->pincode,
    //     'minimum_project_value' => $request->minimum_project_value,
    //     'aadhaar_card' => $aadhaarCard,
    //     'company_profile' => $companyProfile,
    //     'nabl_certificate' => $nablCertificate,
    //     'lab_photos' => json_encode($labPhotos),
    //     'accreditation_certificate' => $accreditationCertificate,
    // ];
    $data = [
    'vendor_id' => $vendorId,
    'services' => $request->services ?? [],
    'lab_type' => $request->lab_type,
    'certification' => $request->certification,
    'service_mode' => $request->service_mode ?? [],
    'sample_pickup_available' => $request->has('sample_pickup_available') ? 1 : 0,
    'gst_certificate' => $gstCertificate,
    'team_size' => $request->team_size,
    'experience_years' => $request->experience_years,
    'city_id' => $request->city_id,
    'area_ids' => $request->area_ids ?? [],
    'pincode' => $request->pincode,
    'minimum_project_value' => $request->minimum_project_value,
    'aadhaar_card' => $aadhaarCard,
    'company_profile' => $companyProfile,
    'nabl_certificate' => $nablCertificate,
    'lab_photos' => $labPhotos,
    'accreditation_certificate' => $accreditationCertificate,
];

    TestingService::updateOrCreate(
        ['vendor_id' => $vendorId],
        $data
    );

    return back()->with('success', 'Saved successfully');
}
}