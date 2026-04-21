<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestingService;

class TestingController extends Controller
{
   
    public function store(Request $request)
    {
        // dd($request);
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
             'team_size' => 'required',
        'city_id' => 'required',
        'area_ids' => 'required|array',
        'pincode' => 'required|string',
        'minimum_project_value' => 'required',
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
             'team_size' => $request->team_size,
             'city_id' => $request->city_id,'area_ids' => $request->area_ids,
             'pincode' => $request->pincode,'minimum_project_value' => $request->minimum_project_value,
            
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