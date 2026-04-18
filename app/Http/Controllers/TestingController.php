<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestingService;

class TestingController extends Controller
{
    // public function store(Request $request)
    // {
    //     $vendorId = session('vendor_id');
    //     dd($request);
    //     if (!$vendorId) {
    //         return redirect()->route('login')->with('error', 'Please login first.');
    //     }

    //     $request->validate([
    //         'services' => 'nullable|array',
    //         'lab_type' => 'nullable|string|in:in_house,third_party',
    //         'service_mode' => 'nullable|array',
    //         'service_mode.*' => 'nullable|string|in:field_testing,lab_testing',
    //         'certification' => 'nullable|string|in:nabl_certified,non_certified',
    //         'sample_pickup_available' => 'nullable|in:1,on',

    //         'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    //         'aadhaar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    //         'company_profile' => 'nullable|file|mimes:pdf,doc,docx|max:4096',
    //         'nabl_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    //         'lab_photos' => 'nullable|array',
    //         'lab_photos.*' => 'nullable|file|mimes:jpg,jpeg,png|max:4096',
    //         'accreditation_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    //     ]);

    //     $testingService = TestingService::where('vendor_id', $vendorId)->first();

    //     $uploadFile = function ($inputName, $folder, $oldValue = null) use ($request) {
    //         if ($request->hasFile($inputName)) {
    //             return $request->file($inputName)->store($folder, 'public');
    //         }
    //         return $oldValue;
    //     };

    //     $gstCertificate = $uploadFile('gst_certificate', 'testing_services', $testingService->gst_certificate ?? null);
    //     $aadhaarCard = $uploadFile('aadhaar_card', 'testing_services', $testingService->aadhaar_card ?? null);
    //     $companyProfile = $uploadFile('company_profile', 'testing_services', $testingService->company_profile ?? null);
    //     $nablCertificate = $uploadFile('nabl_certificate', 'testing_services', $testingService->nabl_certificate ?? null);
    //     $accreditationCertificate = $uploadFile('accreditation_certificate', 'testing_services', $testingService->accreditation_certificate ?? null);

    //     $labPhotos = [];
    //     if ($testingService && !empty($testingService->lab_photos)) {
    //         $decodedPhotos = json_decode($testingService->lab_photos, true);
    //         $labPhotos = is_array($decodedPhotos) ? $decodedPhotos : [];
    //     }

    //     if ($request->hasFile('lab_photos')) {
    //         $labPhotos = [];
    //         foreach ($request->file('lab_photos') as $photo) {
    //             $labPhotos[] = $photo->store('testing_services/lab_photos', 'public');
    //         }
    //     }

    //     TestingService::updateOrCreate(
    //         ['vendor_id' => $vendorId],
    //         [
    //             'services' => json_encode($request->services ?? []),
    //             'lab_type' => $request->lab_type,
    //             'certification' => $request->certification,
    //             'service_mode' => json_encode($request->service_mode ?? []),
    //             'sample_pickup_available' => $request->has('sample_pickup_available') ? 1 : 0,
    //             'gst_certificate' => $gstCertificate,
    //             'aadhaar_card' => $aadhaarCard,
    //             'company_profile' => $companyProfile,
    //             'nabl_certificate' => $nablCertificate,
    //             'lab_photos' => json_encode($labPhotos),
    //             'accreditation_certificate' => $accreditationCertificate,
    //         ]
    //     );

    //     return redirect()->back()->with('success', 'Testing service details saved successfully.');
    // }
    public function store(Request $request)
{
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        dd('Vendor ID missing in session');
    }

    // Validate
    $request->validate([
        'services' => 'nullable|array',
        'lab_type' => 'nullable|string',
        'service_mode' => 'nullable|array',
        'certification' => 'nullable|string',
    ]);

    // File upload helper
    $uploadFile = function ($inputName) use ($request) {
        if ($request->hasFile($inputName)) {
            return $request->file($inputName)->store('testing_services', 'public');
        }
        return null;
    };

    // Upload files
    $gstCertificate = $uploadFile('gst_certificate');
    $aadhaarCard = $uploadFile('aadhaar_card');
    $companyProfile = $uploadFile('company_profile');
    $nablCertificate = $uploadFile('nabl_certificate');
    $accreditationCertificate = $uploadFile('accreditation_certificate');

    // Multiple photos
    $labPhotos = [];
    if ($request->hasFile('lab_photos')) {
        foreach ($request->file('lab_photos') as $photo) {
            $labPhotos[] = $photo->store('testing_services/lab_photos', 'public');
        }
    }

    // 🔥 IMPORTANT: SAVE DATA
    $data = [
        'vendor_id' => $vendorId,
        'services' => json_encode($request->services),
        'lab_type' => $request->lab_type,
        'certification' => $request->certification,
        'service_mode' => json_encode($request->service_mode),
        'sample_pickup_available' => $request->has('sample_pickup_available') ? 1 : 0,
        'gst_certificate' => $gstCertificate,
        'aadhaar_card' => $aadhaarCard,
        'company_profile' => $companyProfile,
        'nabl_certificate' => $nablCertificate,
        'lab_photos' => json_encode($labPhotos),
        'accreditation_certificate' => $accreditationCertificate,
    ];

    // 🔥 DEBUG BEFORE SAVE
    // dd($data);

    // SAVE
    TestingService::updateOrCreate(
        ['vendor_id' => $vendorId],
        $data
    );

    return back()->with('success', 'Saved successfully');
}
}