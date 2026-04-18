<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InteriorProvider;


class InteriorController extends Controller
{
    public function create()
    {
        return view('vendor.category.interior-registration');
    }

 

    // public function store(Request $request)
    // {
    //     $vendorId = session('vendor_id');

    //     if (!$vendorId) {
    //         return redirect()->route('login')->with('error', 'Login required');
    //     }

    //     $request->validate([
    //         'project_types' => 'required|array',
    //         'project_types.*' => 'string',
    //         'company_name' => 'required|string',
    //         'minimum_project_value' => 'required',
    //         'registered_address' => 'required|string',
    //         'contact_person_name' => 'required|string',

    //         'pan_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
    //         'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
    //         'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
    //         'supporting_documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
    //         'portfolio_images.*' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
    //     ]);

    //     $panCardPath = $request->hasFile('pan_card')
    //         ? $request->file('pan_card')->store('interior/pan-card', 'public')
    //         : null;

    //     $gstCertificatePath = $request->hasFile('gst_certificate')
    //         ? $request->file('gst_certificate')->store('interior/gst-certificate', 'public')
    //         : null;

    //     $companyProfilePath = $request->hasFile('company_profile')
    //         ? $request->file('company_profile')->store('interior/company-profile', 'public')
    //         : null;

    //     $supportingDocumentsPath = $request->hasFile('supporting_documents')
    //         ? $request->file('supporting_documents')->store('interior/supporting-documents', 'public')
    //         : null;

    //     $portfolioImage1 = null;
    //     $portfolioImage2 = null;
    //     $portfolioImage3 = null;

    //     if ($request->hasFile('portfolio_images')) {
    //         $portfolioImages = $request->file('portfolio_images');

    //         $portfolioImage1 = isset($portfolioImages[0])
    //             ? $portfolioImages[0]->store('interior/portfolio', 'public')
    //             : null;

    //         $portfolioImage2 = isset($portfolioImages[1])
    //             ? $portfolioImages[1]->store('interior/portfolio', 'public')
    //             : null;

    //         $portfolioImage3 = isset($portfolioImages[2])
    //             ? $portfolioImages[2]->store('interior/portfolio', 'public')
    //             : null;
    //     }

    //     InteriorProvider::create([
    //         'vendor_id' => $vendorId,
    //         'project_types' => $request->project_types,
    //         'experience_years' => $request->experience_years,
    //         'team_size' => $request->team_size,
        
    //         'city' => $request->city,
    //         'pincode' => $request->pincode,
    //         'minimum_project_value' => $request->minimum_project_value,

    //         'company_name' => $request->company_name,
    //         'entity_type' => $request->entity_type,
    //         'registered_address' => $request->registered_address,
    //         'contact_person_designation' => $request->contact_person_designation,
    //         'contact_person_name' => $request->contact_person_name,

    //         'pan_number' => $request->pan_number,
    //         'gst_number' => $request->gst_number,
        
    //         'pan_card' => $panCardPath,
    //         'gst_certificate' => $gstCertificatePath,
    //         'company_profile' => $companyProfilePath,
        
    //         'portfolio_image_1' => $portfolioImage1,
    //         'portfolio_image_2' => $portfolioImage2,
    //         'portfolio_image_3' => $portfolioImage3,
    //     ]);

    //     return back()->with('success', 'Data saved successfully');
    // }
    public function store(Request $request)
{
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return redirect()->route('login')->with('error', 'Login required');
    }

    $request->validate([
        'project_types' => 'required|array',
        'project_types.*' => 'string',
        'company_name' => 'required|string',
        'minimum_project_value' => 'required',
        'registered_address' => 'required|string',
        'contact_person_name' => 'required|string',

        'pan_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        'supporting_documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        'portfolio_images.*' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
    ]);

    $existing = InteriorProvider::where('vendor_id', $vendorId)->first();

    $panCardPath = $existing?->pan_card;
    if ($request->hasFile('pan_card')) {
        $panCardPath = $request->file('pan_card')->store('interior/pan-card', 'public');
    }

    $gstCertificatePath = $existing?->gst_certificate;
    if ($request->hasFile('gst_certificate')) {
        $gstCertificatePath = $request->file('gst_certificate')->store('interior/gst-certificate', 'public');
    }

    $companyProfilePath = $existing?->company_profile;
    if ($request->hasFile('company_profile')) {
        $companyProfilePath = $request->file('company_profile')->store('interior/company-profile', 'public');
    }

    $supportingDocumentsPath = $existing?->supporting_documents;
    if ($request->hasFile('supporting_documents')) {
        $supportingDocumentsPath = $request->file('supporting_documents')->store('interior/supporting-documents', 'public');
    }

    $portfolioImage1 = $existing?->portfolio_image_1;
    $portfolioImage2 = $existing?->portfolio_image_2;
    $portfolioImage3 = $existing?->portfolio_image_3;

    if ($request->hasFile('portfolio_images')) {
        $portfolioImages = $request->file('portfolio_images');

        if (isset($portfolioImages[0])) {
            $portfolioImage1 = $portfolioImages[0]->store('interior/portfolio', 'public');
        }

        if (isset($portfolioImages[1])) {
            $portfolioImage2 = $portfolioImages[1]->store('interior/portfolio', 'public');
        }

        if (isset($portfolioImages[2])) {
            $portfolioImage3 = $portfolioImages[2]->store('interior/portfolio', 'public');
        }
    }

    InteriorProvider::updateOrCreate(
        ['vendor_id' => $vendorId],
        [
            'project_types' => $request->project_types,
            'experience_years' => $request->experience_years,
            'team_size' => $request->team_size,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'minimum_project_value' => $request->minimum_project_value,

            'company_name' => $request->company_name,
            'entity_type' => $request->entity_type,
            'registered_address' => $request->registered_address,
            'contact_person_designation' => $request->contact_person_designation,
            'contact_person_name' => $request->contact_person_name,

            'pan_number' => $request->pan_number,
            'gst_number' => $request->gst_number,

            'pan_card' => $panCardPath,
            'gst_certificate' => $gstCertificatePath,
            'company_profile' => $companyProfilePath,
            'supporting_documents' => $supportingDocumentsPath,

            'portfolio_image_1' => $portfolioImage1,
            'portfolio_image_2' => $portfolioImage2,
            'portfolio_image_3' => $portfolioImage3,
        ]
    );

    return back()->with('success', 'Data saved successfully');
}
}